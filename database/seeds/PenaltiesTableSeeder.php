<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use App\Models\Penalty\Penalty;
use Ramsey\Uuid\Uuid;

final class PenaltiesTableSeeder extends Seeder
{
    public function run() : void
    {
        foreach ($this->penalties() as $penalty)
            if (! Penalty::whereName($penalty['name'])->first()) {
                $penalty['code'] = Uuid::uuid4()->toString();
                $penalty['slug'] = str_slug($penalty['name']);
                Penalty::firstOrCreate($penalty);
            }
    }

    private function penalties() : array
    {
        return [
            ['name' => "Bloodstain", 'rate' => 50],
            ['name' => "Lavatory", 'rate' => 2500],
            ['name' => "Toilet Bowl", 'rate' => 3000],
            ['name' => "TV", 'rate' => 20000],
            ['name' => "Decorder Box", 'rate' => 20000],
            ['name' => "Table", 'rate' => 1000],
            ['name' => "Chair", 'rate' => 1000],
            ['name' => "Drinking Glass", 'rate' => 50],
            ['name' => "Mirror", 'rate' => 500],
            ['name' => "Plate", 'rate' => 100],
            ['name' => "Trash Can", 'rate' => 100],
            ['name' => "Bucket", 'rate' => 100],
            ['name' => "Smoking", 'rate' => 1000],
            ['name' => "Door Knob", 'rate' => 1000],
            ['name' => "Water Dipper/Kabo", 'rate' => 50],
            ['name' => "Vandalism", 'rate' => 1500],
            ['name' => "Intercom", 'rate' => 1500],
            ['name' => "Door", 'rate' => 3000],
            ['name' => "Pillow", 'rate' => 300],
            ['name' => "Pillow Case", 'rate' => 300],
            ['name' => "Towel", 'rate' => 300],
            ['name' => "Vase", 'rate' => 200],
            ['name' => "Bedsheet", 'rate' => 500],
            ['name' => "Shower Head", 'rate' => 600],
            ['name' => "Heater", 'rate' => 3000],
            ['name' => "Faucet", 'rate' => 0],
            ['name' => "Bed", 'rate' => 0],
        ];
    }
}
