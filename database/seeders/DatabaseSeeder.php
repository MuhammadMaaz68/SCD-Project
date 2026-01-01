<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Ensure Hash is imported

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create specific Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Create some random users
        User::factory(5)->create();

        // 2. Create Categories
        $categories = Category::factory(10)->create();

        // 3. Create Products assigned to those categories
        $products = Product::factory(50)->recycle($categories)->create();

        // 4. Create Books (Legacy) assigned to categories
        Book::factory(20)->recycle($categories)->create();

        // 5. Create Orders for Test User and Random Users
        $users = User::all();

        foreach ($users as $user) {
            // Create 1-3 orders for each user
            Order::factory(rand(1, 3))->create([
                'user_id' => $user->id,
            ])->each(function ($order) use ($products) {
                // Attach random products to each order
                $orderProducts = $products->random(rand(2, 5));
                foreach ($orderProducts as $product) {
                    OrderItem::factory()->create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => rand(1, 3),
                        'price' => $product->price, // Use actual product price
                    ]);
                }
                
                // Recalculate total price based on created items
                $total = $order->items->sum(function($item) {
                    return $item->price * $item->quantity;
                });
                $order->update(['total_price' => $total]);
            });
        }
    }
}
