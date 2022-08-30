<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerProfileController extends Controller
{
  /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('web')->User();
            return $next($request);
        });
    }
    /**
     * Show the authenticated user profile
     */
    public function index(){
        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        $customer = User::where('email',Auth::guard('web')->User()->email)->first();
        return view('customer.pages.profile.index',[
            'customer' => $customer
        ]);
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request){
        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $id = Auth::guard('web')->User()->id;

        if (Hash::check($request->old_password,Auth::guard('web')->User()->password)) {
            User::where('id',Auth::guard('web')->User()->id)->update([
                'password' => Hash::make($request->password),
             ]);
            Auth::loginUsingId($id);

             return back()->with('password_changed','Password Change Successfully');
         }

         return back()->with('password_not_match','Password does not match with previous Password');
    }


    /**
     * Update Genearl Information
     */
    public function update(Request $request){

        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        $customer = User::where('email',Auth::guard('web')->User()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$customer->id,
        ]);
        $imageService = new ImageService();

        $image_name = $customer->photo;
        $image_location = 'photo/user_profile/';
        if($request->hasFile('photo')){
            if($image_name != 'default.jpg'){
                $imageService->delete($image_name,$image_location);
            }
            $image_name = $imageService->upload($request->name,$image_location,$request->file('photo'));
        }
        User::where('email',$customer->email)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $image_name,
        ]);

       return back()->with('profile_updated',"Profile Update Successfully");
    }

}