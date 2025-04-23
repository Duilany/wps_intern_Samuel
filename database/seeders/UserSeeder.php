<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Direktur
        $direktur = User::create([
            'name' => 'Direktur Utama',
            'email' => 'direktur@mail.com',
            'password' => Hash::make('password'),
            'role' => 'direktur',
            'manager_id' => null,
        ]);

        // Manager Operasional
        $managerOps = User::create([
            'name' => 'Manager Operasional',
            'email' => 'manager.ops@mail.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'manager_id' => $direktur->id,
        ]);

        // Manager Keuangan
        $managerKeu = User::create([
            'name' => 'Manager Keuangan',
            'email' => 'manager.keu@mail.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'manager_id' => $direktur->id,
        ]);

        // Staf Operasional
        User::create([
            'name' => 'Staf Operasional',
            'email' => 'staf.ops@mail.com',
            'password' => Hash::make('password'),
            'role' => 'staf',
            'manager_id' => $managerOps->id,
        ]);

        // Staf Keuangan
        User::create([
            'name' => 'Staf Keuangan',
            'email' => 'staf.keu@mail.com',
            'password' => Hash::make('password'),
            'role' => 'staf',
            'manager_id' => $managerKeu->id,
        ]);
    }
}
