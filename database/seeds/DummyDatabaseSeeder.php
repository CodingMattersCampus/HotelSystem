<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

final class DummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        $this->call(DummyEmployeeTableSeeder::class);
//        $this->call(DummyRemittanceSeeder::class);
    }
}
