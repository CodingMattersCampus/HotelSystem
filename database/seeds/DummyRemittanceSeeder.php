<?php

use Illuminate\Database\Seeder;
use App\Models\Cash\Drawer;
use App\Models\Cash\Remittance;

class DummyRemittanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$cashier = App\Models\User\Employee::where('role','cashier')->first()->code;

        \factory(App\Models\Cash\Drawer::class, 5)
        	->create([
        		'cashier' => $cashier
        	])
        	->each(function(Drawer $drawer) use ($cashier){
        		\factory(Remittance::class)
        			->create([
        				'cashier'=> $cashier,
        				'drawer' => $drawer->code
        			]);
        	});
    }
}
