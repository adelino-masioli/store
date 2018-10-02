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
            'theme'        => 'acqua',
            'url'          => 'http://localhost:8000',
            'url_security' => 'https://localhost:8000',
            'name'         => 'Empresa Teste',
            'nickname'     => 'empresa-teste',
            'contact'      => 'Contato Teste',
            'email'        => 'empresa@teste.com.br',
            'phone'        => '0000000000',
            'theme_id'     => 1,
            'status_id'    => 1
        ]);
    }
}
