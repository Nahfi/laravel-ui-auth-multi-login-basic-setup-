<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles,HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $guarded = [

   ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return App\Models\User order by desc
     */
    public static function allUserDesc(){
        return User::orderBy('id','desc')->get();
    }
    /**
     * @return App\Models\User group status count *
     * 
     */
    public static function groupByStatusCount(){
        $user_info = DB::table('users')
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();
        return $user_info;
    }

    /**
     * show a specific user
     * @param int $id
     * @return App\Models\User
     */
    public static function specefiUser($id){
        return User::where('id',$id)->first();
    }

     /**
     * Get the user name who create this category
     */
    public function createdBy(){
        return $this->belongsTo('App\Models\Admin','created_by','id');
    }
    /**
     * Get the user name who edit this category
     */
    public function editedBy(){
        return $this->belongsTo('App\Models\Admin','edited_by','id');
    }

    public static function trashItemCount(){
        return User::onlyTrashed()->count();
    }

   
}
