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
            'name'               => 'Administrador',
            'email'              => 'admin@admin.com',
            'password'           => bcrypt('123456'),
            'type_id'            => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Gestor',
            'email'              => 'gestor@gestor.com',
            'password'           => bcrypt('gestor123456'),
            'type_id'            => 2,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Moderador',
            'email'              => 'moderador@moderador.com',
            'password'           => bcrypt('moderador123456'),
            'type_id'            => 3,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);

        DB::table('users')->insert([
            'name'               => 'Usuário',
            'email'              => 'usuario@usuario.com',
            'password'           => bcrypt('usuario123456'),
            'type_id'            => 4,
            'configuration_id'   => 1,
            'status_id'          => 1,
        ]);
    }
}
