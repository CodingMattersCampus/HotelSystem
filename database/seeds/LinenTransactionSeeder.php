<?php

use Illuminate\Database\Seeder;
use App\Models\Inventory\Linen;
use App\Models\Inventory\Linen\LinenTransaction;
use App\Models\Room\Room;

class LinenTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\Models\User\Employee::all()->random();
        Linen::take(2)->get()->each(function($linen) use ($user){
            //inventory
            $step1 = \factory(LinenTransaction::class)->create([
                'slug'          => $linen->slug,
                'description'   => 'Booking default inventory',
                'out'           => rand(1,4),
                'on'            => 'stocks',
            ]);
            //Edit linen
            $linen->addRoomsCount($step1->out);

            $step2 = \factory(LinenTransaction::class)->create([
                'slug'        => $linen->slug,
                'description' => 'Booking default inventory',
                'in'          => $step1->out,
                'room'        => Room::all()->random()->name,
                'on'          => 'rooms',
            ]);

            \factory(LinenTransaction::class)->create([
                'slug' => $linen->slug,
                'description' => 'to laundry linens',
                'out'         => $step1->out,
                'room'        => $step2->room,
                'on'          => 'rooms',
            ]);

            $linen->toLaundry($step1->out);

            \factory(LinenTransaction::class)->create([
                'slug' => $linen->slug,
                'description' => 'laundring',
                'in'          => $step1->out,
                'on'          => 'laundry',
            ]);

        });
    }
}
