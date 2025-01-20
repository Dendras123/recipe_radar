<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TechUserSeeder extends Seeder
{
    public const RECIPE_TECH_USER = 'recipe_tech_user@recipe_radar.com';

    public const TECH_USER_EMAILS = [self::RECIPE_TECH_USER];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::TECH_USER_EMAILS as $email) {
            User::firstOrCreate(
                [
                    'email' => $email
                ],
                [
                    'name' => fake()->name(),
                    'password' => fake()->password(),
                ]
            );
        }
    }
}
