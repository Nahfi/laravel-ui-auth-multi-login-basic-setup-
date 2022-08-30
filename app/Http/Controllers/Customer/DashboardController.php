<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Customer\DashboardRepository;

class DashboardController extends Controller
{

    /**
     * constract a method
     */
    public $dashboardRepository;
    public function __construct()
    {
        $this->dashboardRepository = new dashboardRepository();
    }

    /**
     * Show the user dashboard
     */
     public function index(){

        return view('customer.pages.home.index',);
     }
}