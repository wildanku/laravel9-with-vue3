<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'email'         => 'test@mail.com',
            'password'      => Hash::make('password'),
            'phone'         => '628931923192'
        ]);
    }
}
