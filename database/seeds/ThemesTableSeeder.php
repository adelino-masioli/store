<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            'name'         => "Acqua",
            'slug'         => "acqua",
            'image'        => "acqua.jpg",
            'description'  => "Tema Acqua",
            'status_id'    => 1
        ]);
    }
}
