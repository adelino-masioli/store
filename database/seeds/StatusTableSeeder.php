<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'status'  => 'Ativo',
            'flag'    => 'default',
        ]);

        DB::table('status')->insert([
            'status'  => 'Inativo',
            'flag'    => 'default',
        ]);

        DB::table('status')->insert([
            'status'  => 'Aberto',
            'flag'    => 'reader',
        ]);

        DB::table('status')->insert([
            'status'  => 'Fechado',
            'flag'    => 'reader',
        ]);
    }
}
