<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Administrador',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123456'),
            'type_id'   => 1,
            'status_id' => 1,
        ]);
    }
}
