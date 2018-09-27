<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'type'  => 'Aprovação do cliente'
        ]);
        DB::table('document_types')->insert([
            'type'  => 'Diversos'
        ]);
        DB::table('document_types')->insert([
            'type'  => 'Documento Financeiro'
        ]);
    }
}
