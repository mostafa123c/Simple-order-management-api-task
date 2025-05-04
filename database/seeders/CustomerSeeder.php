<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 customers with fake data
        for ($i = 0; $i < 20; $i++) {
            Customer::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
            ]);
        }

        // Create a test customer with fixed data for testing
        Customer::create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
        ]);
    }
}