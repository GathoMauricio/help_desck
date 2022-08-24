<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_rol_id' => 1,
            'company_branch_id' => 1,
            'name' => 'Mauricio',
            'middle_name' => 'Ju',
            'last_name' => 'So',
            'phone' => '5545784578',
            'email' => 'mauricio@gmail.com',
            'password' => 'Hannibal2769',
        ]);
    }
}
