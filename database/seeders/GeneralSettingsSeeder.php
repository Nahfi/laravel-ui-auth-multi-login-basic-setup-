<?php

namespace Database\Seeders;

use App\Models\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSettings::create([
            'name' => 'Nafiz Khan',
            'phone' => '01616243666',
            'email' => 'nafiz0khan1@gmail.com',
            'address' => 'H-09'
        ]);
    }
}