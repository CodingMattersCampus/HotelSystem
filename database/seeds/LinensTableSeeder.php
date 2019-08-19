<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use App\Models\Inventory\Linen;

final class LinensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        foreach ($this->linens() as $linen)
            if (! Linen::whereName($linen['name'])->first()){
                $linen['slug'] = str_slug($linen['name']);
                $linen['stocks'] = random_int(1, 200);
                Linen::firstOrCreate($linen);
            }

    }

    private function linens() : array
    {
        return [
            ['name' => "Blanket"],
            ['name' => "Bedsheet"],
            ['name' => "Towel"],
            ['name' => "Pillow"],
            ['name' => "Pillow Case"],
        ];
    }
}
