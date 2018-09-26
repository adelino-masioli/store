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
            'type'  => 'Administrador'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Moderador'
        ]);

        DB::table('user_types')->insert([
            'type'  => 'Usuário'
        ]);
    }
}
