<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'               => 'Super Administrador',
            'email'              => 'superadmin@superadmin.com',
            'password'           => bcrypt('123456'),
            'active'             => 1,
            'type_id'            => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Administrador',
            'email'              => 'admin@admin.com',
            'password'           => bcrypt('admin123456'),
            'active'             => 1,
            'type_id'            => 2,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Gerente',
            'email'              => 'gerente@gerente.com',
            'password'           => bcrypt('gerente123456'),
            'active'             => 1,
            'type_id'            => 3,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Usuários',
            'email'              => 'usuario@usuario.com',
            'password'           => bcrypt('usuario123456'),
            'active'             => 1,
            'type_id'            => 4,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Financeiro',
            'email'              => 'financeiro@financeiro.com',
            'password'           => bcrypt('financeiro123456'),
            'active'             => 1,
            'type_id'            => 5,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Produção',
            'email'              => 'producao@producao.com',
            'password'           => bcrypt('producao123456'),
            'active'             => 1,
            'type_id'            => 6,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);


        DB::table('users')->insert([
            'name'               => 'Expedição',
            'email'              => 'expedicao@expedicao.com',
            'password'           => bcrypt('expedicao123456'),
            'active'             => 1,
            'type_id'            => 7,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Cliente',
            'email'              => 'cliente@cliente.com',
            'password'           => bcrypt('cliente123456'),
            'active'             => 1,
            'type_id'            => 8,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);
    }
}
