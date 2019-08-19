<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use App\Models\Room\Room;
use App\Models\Room\RoomRate;
use App\Models\Room\RoomStatus;
use App\Models\Room\RoomTransaction;
use Ramsey\Uuid\Uuid;

final class RoomTableSeeder extends Seeder
{
    public function run() : void
    {
        for ($number = 1; $number <= 40; $number ++) {
            switch ($number) {
                case ($number == 1 || $number == 2): {
                    $room = factory(Room::class)->create([
                        'name' => str_pad((string) $number, 2, "0", STR_PAD_LEFT),
                        'type' => 'non-garage',
                    ]);

                    RoomRate::firstOrCreate([
                        'room'  => $room->code,
                        'ST'    => 300.00,
                        'HD'    => 690.00,
                        'WD'    => 950.00,
                    ]);


                    RoomTransaction::firstOrCreate([
                        'code'      => Uuid::uuid4()->toString(),
                        'room'      => $room->code,
                        'status'    => RoomStatus::AVAILABLE,
                    ]);
                    break;
                }
                case (
                    ($number >= 3 && $number <= 16)
                    || ($number >= 20 && $number <= 23)
                ) : {
                    $room = factory(Room::class)->create([
                        'name' => str_pad((string) $number, 2, "0", STR_PAD_LEFT),
                        'type' => 'garage',
                    ]);

                    RoomRate::firstOrCreate([
                        'room'  => $room->code,
                        'ST'    => 350.00,
                        'HD'    => 890.00,
                        'WD'    => 1290.00,
                    ]);

                    RoomTransaction::firstOrCreate([
                        'code'      => Uuid::uuid4()->toString(),
                        'room'      => $room->code,
                        'status'    => RoomStatus::AVAILABLE,
                    ]);
                    break;
                }
                case (
                    ($number >= 17 && $number <= 19)
                    || ($number >= 26 && $number <= 32)
                    || ($number >= 34 && $number <= 39)
                ) : {
                    $room = factory(Room::class)->create([
                        'name' => str_pad((string) $number, 2, "0", STR_PAD_LEFT),
                        'type' => 'walk-in',
                    ]);

                    RoomRate::firstOrCreate([
                        'room'  => $room->code,
                        'ST'    => 300.00,
                        'HD'    => 390.00,
                        'WD'    => 690.00,
                    ]);

                    RoomTransaction::firstOrCreate([
                        'code'      => Uuid::uuid4()->toString(),
                        'room'      => $room->code,
                        'status'    => RoomStatus::AVAILABLE,
                    ]);
                    break;
                }
                case ($number == 33 || $number == 40): {
                    $room = factory(Room::class)->create([
                        'name' => str_pad((string) $number, 2, "0", STR_PAD_LEFT),
                        'type' => 'family',
                    ]);

                    RoomRate::firstOrCreate([
                        'room'  => $room->code,
                        'ST'    => 690.00,
                        'HD'    => 690.00,
                        'WD'    => 1000.00,
                    ]);

                    RoomTransaction::firstOrCreate([
                        'code'      => Uuid::uuid4()->toString(),
                        'room'      => $room->code,
                        'status'    => RoomStatus::AVAILABLE,
                    ]);
                    break;
                }
            }
        }
    }
}
