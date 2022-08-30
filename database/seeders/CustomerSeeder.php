<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


use function PHPUnit\Framework\isNull;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = User::where('email','customer@example.com')->first();
        if(isNull($customer)){
           $customer =  User::create([
                'name' => 'Customer',
                'email' => 'customer@example.com',
                'phone' => '1234567',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456789'),
                'status' => 'Active',
                'created_by' => 1
            ]);
        }

    }
}
