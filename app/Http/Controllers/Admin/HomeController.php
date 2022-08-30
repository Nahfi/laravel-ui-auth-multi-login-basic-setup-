<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\HomeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Construct method
     */
    public $user,$homeRepository;
    public function __construct(HomeRepository $homeRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->homeRepository = $homeRepository;
    }

    /**
     * show all report
     */
    public function index(){
        $data = $this->homeRepository->index();
        return view('admin.pages.home.index',[
            'data' => $data
        ]);
    }
}
