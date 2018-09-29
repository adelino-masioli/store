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

        DB::table('status')->insert([
            'status'  => 'Não baixado',
            'flag'    => 'document',
        ]);

        DB::table('status')->insert([
            'status'  => 'Baixado',
            'flag'    => 'document',
        ]);

        DB::table('status')->insert([
            'status'  => 'Processando',
            'flag'    => 'order',
        ]);
        DB::table('status')->insert([
            'status'  => 'Financeiro',
            'flag'    => 'order',
        ]);
        DB::table('status')->insert([
            'status'  => 'Produção',
            'flag'    => 'order',
        ]);
        DB::table('status')->insert([
            'status'  => 'Finalizado',
            'flag'    => 'order',
        ]);
        DB::table('status')->insert([
            'status'  => 'Expedição',
            'flag'    => 'order',
        ]);
        DB::table('status')->insert([
            'status'  => 'Entregue',
            'flag'    => 'order',
        ]);
        DB::table('status')->insert([
            'status'  => 'Cancelado',
            'flag'    => 'order',
        ]);
    }
}
