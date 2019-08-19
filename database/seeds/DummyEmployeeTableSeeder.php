<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use App\Models\User\Employee;
use Tests\Helpers\DummyEmployeeFactory;

final class DummyEmployeeTableSeeder extends Seeder
{
    use DummyEmployeeFactory;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        if (!Employee::whereUsername('cashier')->first())
            $this->mockCashierEmployee();

        if (!Employee::whereUsername('rose')->first())
            $this->mockCashierEmployee('rose', "Rose", "Petal");

        if (!Employee::whereUsername('jack')->first())
            $this->mockCashierEmployee('jack', 'Jack', "Stone");
    }
}
