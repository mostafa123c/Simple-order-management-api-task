<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all customer IDs
        $customerIds = Customer::pluck('id')->toArray();

        // Product names for random selection
        $products = [
            'Laptop',
            'Smartphone',
            'Headphones',
            'Monitor',
            'Keyboard',
            'Mouse',
            'Tablet',
            'Printer',
            'Camera',
            'Speaker'
        ];

        // Create 50 orders with random data
        for ($i = 0; $i < 50; $i++) {
            Order::create([
                'customer_id' => fake()->randomElement($customerIds),
                'product_name' => fake()->randomElement($products),
                'quantity' => fake()->numberBetween(1, 10),
                'price' => fake()->randomFloat(2, 10, 1000),
                'status' => fake()->randomElement(['pending', 'shipped']),
            ]);
        }

        // Create a few orders for the test customer
        $testCustomerId = Customer::where('email', 'customer@example.com')->first()->id;

        // Create a pending order
        Order::create([
            'customer_id' => $testCustomerId,
            'product_name' => 'Test Product 1',
            'quantity' => 2,
            'price' => 99.99,
            'status' => 'pending',
        ]);

        // Create a shipped order
        Order::create([
            'customer_id' => $testCustomerId,
            'product_name' => 'Test Product 2',
            'quantity' => 1,
            'price' => 149.99,
            'status' => 'shipped',
        ]);
    }
}