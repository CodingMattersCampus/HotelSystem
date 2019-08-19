<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use CodingMatters\Office\Database\Seeders\OfficeDatabaseSeeder;
use CodingMatters\Booking\Database\Seeders\BookingDatabaseSeeder;
use CodingMatters\Store\Database\Seeders\StoreDatabaseSeeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        $this->call(AdminUsersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(LinensTableSeeder::class);
        $this->call(RoomTableSeeder::class);
        $this->call(PenaltiesTableSeeder::class);

        // Module related seeders
        $this->call(OfficeDatabaseSeeder::class);
        $this->call(StoreDatabaseSeeder::class);
        $this->call(BookingDatabaseSeeder::class);
    }
}
