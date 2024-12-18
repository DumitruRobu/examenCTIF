<?php

namespace Database\Seeders;

use App\Models\Iban;
use App\Models\Raion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(storage_path('app/public/raions.csv'), 'r');
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            Raion::create([
                'code' => $data[0],
                'name' => $data[1],
            ]);
        }
        fclose($file);
    }
}
