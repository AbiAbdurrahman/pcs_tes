<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path("database/products.csv"), "r");
        $first_line = true;

        while (($data = fgetcsv($csv_file, 1001, ",")) !== FALSE) {
            if (!$first_line) {
                Product::create([
                    "price"     => $data['1'],
                    "name"      => $data['2'],
                    "quantity"  => $data['3'],
                    "image_url" => $data['4']
                ]);
            }

            $first_line = false;
        }

        fclose($csv_file);
    }
}
