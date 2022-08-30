<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\User;
use App\Repositories\Admin\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
     /**
     * Construct method
     */
    public $user,$customerRepository,$totalTrashItem;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->customerRepository = $customerRepository;
        $this->totalTrashItem = User::trashItemCount();
    }
    /**
     * show all customer
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
        $customers = $this->customerRepository->index();
        $totalTrashItem = $this->totalTrashItem;
        return view('admin.pages.customer.index',[
            'customers' => $customers,
            'totalTrashItem' => $totalTrashItem
        ]);
    }
    /**
     * show all trash customer
     */
    public function trashCustomer(){
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
        $customers = $this->customerRepository->trashItems();
        $totalTrashItem = $this->totalTrashItem;
        return view('admin.pages.customer.index',[
            'customers' => $customers,
            'totalTrashItem' => $totalTrashItem
        ]);
    }
    /**
     * show create new customer form
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('customer.create')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.customer.create');
    }
    /**
     * Store a new customer
     */
    public function store(CustomerStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('customer.create')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->create($request);
        return back()->with('customer_store_success','Customer Store Successfully');
    }
    /**
     * show a sepecefiec customer
     */
    public function show($id){
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
        $customer = $this->customerRepository->getSpecificedItem($id);
        return view('admin.pages.customer.show',[
            'customer' => $customer
        ]);
    }
    /**
     * shoa a edit form of  a customer
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('customer.edit')){
            abort(403,'Unauthorized access');
        }
        $customer = $this->customerRepository->getSpecificedItem($id);
        return view('admin.pages.customer.edit',[
            'customer' => $customer,
        ]);
    }
     /**
     * update a specefied customer
     */
    public function update(CustomerUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('customer.edit')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->update($request,$id);
        return back()->with('customer_update_success','Customer Update Successfully');
    }
    /**
     * delete a specefit employee
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('customer.destroy')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->delete($id);
        return back()->with('customer_delete_success','customer Delete Successfully');

    }
    /**
     * restore a specefied customer
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('customer.restore')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->restore($id);
        return back()->with('customer_delete_success','Customer Delete Successfully');
    }
     /**
     * parmanently delete a employee
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('customer.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->parmanentlyDelete($id);
        return back()->with('customer_parmanent_delete_success','Customer Parmanently Delete Successfulyy');
    }

}
