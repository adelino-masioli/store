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
            'theme'        => 'blue_theme',
            'url'          => 'http://localhost:8000',
            'url_security' => 'https://localhost:8000',
            'name'         => 'Loja Modelo Blue Theme',
            'nickname'     => 'loja-modelo-blue-theme',
            'contact'      => 'Contato Loja Modelo',
            'email'        => 'lojamodelo@teste.com.br',
            'phone'        => '(00)0000-0000',
            'whatsapp'     => '(00)99999-9999',
            'zipcode'      => '30.140-060',
            'address'      => 'Rua dos Timbiras',
            'district'     => 'Funcionários',
            'number'       => '2500',
            'state'        => 'MG',
            'city'         => 'Belo Horizotne',
            'theme_id'     => 2,
            'status_id'    => 1
        ]);
    }
}
