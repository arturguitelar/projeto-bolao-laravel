<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $adminACL = Role::firstOrCreate([
            'name' => 'Admin'
        ], [
            'description' => 'Função de Administrador.'
        ]);

        $managerACL = Role::firstOrCreate([
            'name' => 'Manager'
        ], [
            'description' => 'Função de Gerente.'
        ]);

        // Relacionamentos de Users e Roles
        $userAdmin = User::find(1);
        $userManager = User::find(2);

        $userAdmin->roles()->attach($adminACL);
        $userManager->roles()->attach($managerACL);

        // Permissions
        $listUser = Permission::firstOrCreate([
            'name' => 'list-user'
        ], [
            'description' => 'Pode listar registros.'
        ]);

        $showUser = Permission::firstOrCreate([
            'name' => 'show-user'
        ], [
            'description' => 'Pode listar um registro.'
        ]);

        $createUser = Permission::firstOrCreate([
            'name' => 'create-user'
        ], [
            'description' => 'Pode criar registros.'
        ]);

        $editUser = Permission::firstOrCreate([
            'name' => 'update-user'
        ], [
            'description' => 'Pode editar registros.'
        ]);

        $deleteUser = Permission::firstOrCreate([
            'name' => 'delete-user'
        ], [
            'description' => 'Pode deletar registros.'
        ]);

        // Relacionamento de Roles com Permissions
        $managerACL->permissions()->attach($listUser);
        $managerACL->permissions()->attach($createUser);

        echo "Registros de ACL criados com sucesso!\n";
    }
}
