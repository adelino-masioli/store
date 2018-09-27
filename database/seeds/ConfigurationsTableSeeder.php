<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            'name'       => 'Empresa Teste',
            'contact'    => 'Contato Teste',
            'email'      => 'empresa@teste.com.br',
            'phone'      => '0000000000',
            'status_id'  => 1,
        ]);
    }
}
