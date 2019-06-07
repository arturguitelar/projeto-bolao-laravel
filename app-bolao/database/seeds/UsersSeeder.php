<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria o Admin
        User::firstOrCreate([
            'email' => 'admin@mail.com'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('123456')
        ]);

        // Cria o Gerente
        User::firstOrCreate([
            'email' => 'manager@mail.com'
        ], [
            'name' => 'Manager',
            'password' => Hash::make('123456')
        ]);

        echo "Usuários criados com sucesso!\n";
    }
}
