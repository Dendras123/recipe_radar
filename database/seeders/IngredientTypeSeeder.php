<?php

namespace Database\Seeders;

use App\Models\IngredientType;
use Illuminate\Database\Seeder;

class IngredientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shouldClear = $this->command->option('force');

        if ($shouldClear) {
            IngredientType::getQuery()->delete();
            $this->command->info('IngredientType table cleared.');
        }

        $csvFile = database_path('imports/IngredientsList.csv');

        if (($handle = fopen($csvFile, 'r')) !== false) {
            fgetcsv($handle);

            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                IngredientType::firstOrCreate([
                    'name' => $row[1],
                ]);
            }

            fclose($handle);
        }
    }
}
