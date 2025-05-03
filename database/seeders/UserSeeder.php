<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Check if the default user already exists before creating it
        if (!User::where('email', 'patmark@example.com')->exists()) {
            User::create([
                'name' => 'Patmark',
                'email' => 'patmark@example.com',
                'password' => Hash::make('password123'), // Change password as needed
            ]);
        }
    }
}
