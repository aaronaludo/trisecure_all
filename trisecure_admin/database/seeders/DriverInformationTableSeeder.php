<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverInformation;

class DriverInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DriverInformation::create([
            'driver_id' => 2,
            'status_id' => 1,
            'license' => 'uploads/1702930131.jpg',
            'qr_code' => '2_driver@gmail.com'
        ]);
    }
}
