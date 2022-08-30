<?php
namespace App\Repositories\Admin;

use App\Models\User;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class CustomerRepository{
    public $imageService;
    public $imagename = 'default.jpg';
    public $imageLocation = 'photo/user_profile/';

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * show all customer
     */
    public function index(){
        return User::with(['createdBy','editedBy'])->orderBy('id','asc')->get();
    }

    /**
     * show all trarsh customer
     */
    public function trashItems(){
       return User::onlyTrashed()->with(['createdBy','editedBy'])->orderBy('id','asc')->get();

    }
    /**
     * get specefic customer
     */
    public function getSpecificedItem($id){
        return User::with(['createdBy','editedBy'])->where('id',$id)->first();
    }

    /**
     * get specefied customer from trash
     */
    public function getSpecificedTrashItem($id){
        return User::onlyTrashed()->with(['createdBy','editedBy'])->where('id',$id)->first();
    }
     /**
     * store employees
     */
    public function create($request){
        $customer = new User();
        $customer->status = $request->status;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email_verified_at = Carbon::now();
        $customer->created_by = Auth::guard('admin')->User()->id;
        if($request->hasFile('photo')){
            $this->imageService->upload(str_replace(' ', '', $request->name),$this->imageLocation,$request->photo);
        }
        $customer->save();

    }

    /**
     * update customer information
     */
    public function update($request,$id){
        $customer = $this->getSpecificedItem($id);
        $customer->status = $request->status;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->edited_by = Auth::guard('admin')->User()->id;
        if($request->hasFile('photo')){
            if($customer->photo != $this->imagename){
                $this->imageService->delete($customer->photo,$this->imageLocation);
            }
            $this->imageService->upload(str_replace(' ', '', $request->name),$this->imageLocation,$request->photo);
        }
        $customer->save();

    }
     /**
     * destroy customer
     */
    public function delete($id){

            $item =  $this->getSpecificedItem($id);
            $item->delete();

    }


     /**
     * restore customer
     */
    public function restore($id){
        $expense = $this->getSpecificedTrashItem($id);
        $expense->restore();
    }

    /**
     * parmanently delete
     */
    public function parmanentlyDelete($id){
        $customer = $this->getSpecificedTrashItem($id);
        if($customer->photo != $this->imagename){
            $this->imageService->delete($customer->photo,$this->imageLocation);
        }
        $customer->forceDelete();
    }
}
