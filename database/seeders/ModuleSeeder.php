<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Fetch all users
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('⚠️ No users found. Please seed users first.');
            return;
        }

        // Create between 10–20 random modules
        $moduleCount = rand(10, 20);

        for ($i = 0; $i < $moduleCount; $i++) {
            $randomUser = $users->random();

            Module::create([
                'owner_id' => $randomUser->id,
                'name' => 'Module ' . Str::title(fake()->words(2, true)),
                'description' => fake()->paragraph(3),
            ]);
        }

        $this->command->info("✅ Created {$moduleCount} random modules for existing users.");
    }
}
