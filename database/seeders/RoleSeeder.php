<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Importa correctamente la clase Role
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(["name" => "superadmin", "name_detail" => "Super administrador"]);
        //tiene control total y auditorias

        $register = Role::create(["name" => "register", "name_detail" => "Registrador"]);
        //Accesos a registro de comprobantes y visualizacion de tablas de mantenimiento

        $lector = Role::create(["name" => "lector", "name_detail" => "Lector"]);
        //Accesos a solo lectura

        Permission::create(["name"=>"admin.index"])->assignRole([$superadmin,$register,$lector]);

        //proveedores
        Permission::create(["name"=>"admin.categories.index"])->assignRole([$superadmin,$register,$lector]);
        Permission::create(["name"=>"admin.categories.create"])->assignRole([$superadmin,$register]);
        Permission::create(["name"=>"admin.categories.edit"])->assignRole([$superadmin]);
        Permission::create(["name"=>"admin.categories.listar_categories"])->assignRole([$superadmin,$register,$lector]);
        Permission::create(["name"=>"admin.categories.activation"])->assignRole([$superadmin]); // permiso para activar/desactivar
        Permission::create(["name"=>"admin.categories.destroy"])->assignRole([$superadmin]); // permiso para activar/desactivar

        //usuarios
        Permission::create(["name"=>"admin.users.index"])->assignRole([$superadmin,$register,$lector]);
        Permission::create(["name"=>"admin.users.create"])->assignRole([$superadmin,$register]);
        Permission::create(["name"=>"admin.users.edit"])->assignRole([$superadmin]);
        Permission::create(["name"=>"admin.users.listar_usuarios"])->assignRole([$superadmin,$register,$lector]);
        Permission::create(["name"=>"admin.users.activation"])->assignRole([$superadmin]); // permiso para activar/desactivar
        Permission::create(["name"=>"admin.users.destroy"])->assignRole([$superadmin]); // permiso para activar/desactivar

    }
}
