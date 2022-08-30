<?php

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ConfigSettingsController;

use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Customer\DashboardController;

use App\Http\Controllers\Admin\CustomerController;

use App\Http\Controllers\Admin\EmployeeAttendanceController;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CustomerProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::guard('admin')->check()){
        return redirect()->route('admin.home');
    }
    elseif(Auth::guard('web')->check()){
        return redirect()->route('customer.home');
    }
    return view('welcome');
});

Auth::routes(['verify' => true]);

/**
 * Frontend route start
 */

 Route::as('customer.')->group(function(){
    /**
     * Guest route with web guard start
     */

    /**
     * Guest route with web guard end
     */

    /**
     * Authenticate with web guard start
     */
        Route::middleware(['auth:web','verified','checkStatus'])->prefix('customer')->group(function(){
            //customer home route
           Route::controller(DashboardController::class)->group(function(){
                Route::get('/dashboard','index')->name('home');
           });

            //customer profile route
            Route::controller(CustomerProfileController::class)->prefix('profile')->as('profile.')->group(function(){
                Route::get('/','index')->name('index');
                Route::post('/update','update')->name('update');
                Route::post('/update-password','updatePassword')->name('password.update');

            });



        });
      /**
       * Authenticate with web guard end
       */
    });
 /**
  * Fronend route end
  */
/**
 * admin  route start
 */
    Route::prefix('admin')->as('admin.')->group(function(){

        /**
         * guest route with admin guard start
         */

        Route::middleware('guest:admin')->group(function(){

            //login controller
            Route::controller(LoginController::class)->group(function(){
                Route::get('/login','showLoginForm')->name('login');
                Route::post('/login/post','login')->name('login.post');
            });

            //forgetpassword controller
            Route::controller(ForgotPasswordController::class)->group(function(){
                Route::get('/reset-password','showLinkRequestForm')->name('resetPassword');
                Route::post('/reset-password/post','sendResetLinkEmail')->name('resetpassword.post');
            });

            //reset password controller
            Route::controller(ResetPasswordController::class)->group(function(){
                Route::get('/update-password/{token}','index')->name('updatePassword');
                Route::post('/update-password','update')->name('updatePassword.post');
            });

        });

        /**
         * guest route with admin guard end
         */


         /**
          * Authenticated with admin guard route start
          */
            Route::middleware(['auth:admin','checkStatus'])->group(function(){

                //logout
                Route::controller(LoginController::class)->group(function(){
                    Route::post('/logout','logout')->name('logout');
                });

                //home route
                Route::controller(HomeController::class)->group(function(){
                    Route::get('/dashboard','index')->name('home');
                });

                //roles route
                Route::controller(RolesController::class)->prefix('roles')->as('roles.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');

                });

                //admin route
                Route::controller(AdminController::class)->as('admin.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                });

                //profile route
                Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function(){
                    Route::get('/','index')->name('index');
                    Route::post('/update','update')->name('update');
                    Route::post('/update-password','updatePassword')->name('password.update');

                });

                //settings route
                Route::prefix('settings')->as('settings.')->group(function(){
                    Route::controller(GeneralSettingsController::class)->group(function(){
                        Route::get('/general','generalSettings')->name('general');
                        Route::post('/general/post/{id}','generalSettingsUpdate')->name('general.post');
                    });
                    Route::controller(ConfigSettingsController::class)->group(function(){
                        Route::get('/config','configSettings')->name('config');
                        Route::get('/config-optimize-clear','optimizeClear')->name('config.optimize.clear');
                        Route::get('/config-optimize','optimize')->name('config.optimize');
                    });
                });


                //attendacne route
                Route::controller(EmployeeAttendanceController::class)->prefix('attendance')->as('attendance.')->group(function(){
                    Route::get('/list','index')->name('index');
                    Route::post('status-update/{id}','statusUpdate')->name('statusUpdate');
                });
                //expense  route
                Route::prefix('expense')->as('expense.')->group(function(){
                    //expense category route
                    Route::controller(ExpenseCategoryController::class)->prefix('category')->as('category.')->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::post('/update/{id}','update')->name('update');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');

                        Route::get('/active','showActiveCategory')->name('active');
                        Route::get('/deactive','showDeActiveCategory')->name('deactive');
                        Route::get('/trash','showDeletedCategory')->name('trash');
                        Route::post('/mark','mark')->name('mark');
                    });
                    //expense route
                    Route::controller(ExpenseController::class)->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::post('/update/{id}','update')->name('update');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');

                        Route::get('/active','showActiveExpense')->name('active');
                        Route::get('/deactive','showDeActiveExpense')->name('deactive');
                        Route::get('/trash','showDeletedExpense')->name('trash');

                        Route::post('/mark','mark')->name('mark');
                    });
                });

                //customer route
                Route::controller(CustomerController::class)->prefix('customer')->as('customer.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/show/{id}','show')->name('show');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                    Route::get('/restore/{id}','restore')->name('restore');
                    Route::get('/trash','trashCustomer')->name('trash');
                    Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanenetDelete');
                });















            });
          /**
           * Authenticated with admin guard route end
           */

    });

/**
 * admin  route end
 *
 *
*/


Route::fallback(function () {
    return redirect('/');
});