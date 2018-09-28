<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'payment'  => 'Cartão'
        ]);
        DB::table('payments')->insert([
            'payment'  => 'Cheque'
        ]);
        DB::table('payments')->insert([
            'payment'  => 'Dinheiro'
        ]);
        DB::table('payments')->insert([
            'payment'  => 'Boleto'
        ]);
        DB::table('payments')->insert([
            'payment'  => 'PagSeguro'
        ]);
        DB::table('payments')->insert([
            'payment'  => 'Depósito'
        ]);
    }
}
