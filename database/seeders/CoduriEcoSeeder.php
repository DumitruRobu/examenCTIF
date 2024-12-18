<?php

namespace Database\Seeders;

use App\Models\EcoCodes;
use App\Models\Iban;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoduriEcoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(storage_path('app/public/coduri_eco.txt'), 'r');
        while (($data = fgetcsv($file, 1000)) !== FALSE) {
            EcoCodes::create([
                'codul' => $data[0],
            ]);
        }
        fclose($file);
    }
}
