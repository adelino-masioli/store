<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'type'  => 'Super Administrador'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Administrador'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Gerente'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Usuários'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Financeiro'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Produção'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Expedição'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Cliente'
        ]);
    }
}
