<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
    }
}
