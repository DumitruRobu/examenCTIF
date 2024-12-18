<?php

namespace Database\Seeders;

use App\Models\Iban;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(storage_path('app/public/ibans.csv'), 'r');
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            Iban::create([
                'codul_eco' => $data[0],
                'raion' => $data[1],
                'localitatea' => $data[2],
                'iban_code' => $data[3],
            ]);
        }
        fclose($file);
    }
}
