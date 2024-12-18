<?php

namespace Database\Seeders;

use App\Models\Localitati;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(storage_path('app/public/sate.txt'), 'r');
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            Localitati::create([
                'codul' => $data[0],
                'name' => $data[1],
                'raion_id' => $data[2],
            ]);
        }
        fclose($file);
    }
}
