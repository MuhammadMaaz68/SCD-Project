<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@bookverse.com',
            'password' => bcrypt('password'), // password
            'email_verified_at' => now(),
        ]);

        // 2. Create Categories
        $categories = [
            'Fiction' => 'Imaginary stories and narratives.',
            'Science' => 'Books about the natural world and technology.',
            'History' => 'Accounts of past events and periods.',
            'Technology' => 'Computers, programming, and the future.',
            'Philosophy' => 'Fundamental questions about existence and knowledge.'
        ];

        $categoryIds = [];
        foreach ($categories as $name => $desc) {
            $cat = \App\Models\Category::create([
                'name' => $name,
                'description' => $desc
            ]);
            $categoryIds[$name] = $cat->id;
        }

        // 3. Create Books
        $books = [
            [
                'title' => 'The Silent Library',
                'author' => 'John Cross',
                'description' => 'A mysterious tale of forbidden knowledge.',
                'category_id' => $categoryIds['Fiction'],
                'quantity' => 5,
                'published_year' => 2020,
                'cover_image' => null // Using null for now, or could map to existing dummy images
            ],
            [
                'title' => 'Cosmic Horizons',
                'author' => 'Sarah Vae',
                'description' => 'Exploring the edges of our universe.',
                'category_id' => $categoryIds['Science'],
                'quantity' => 3,
                'published_year' => 2022,
                'cover_image' => null
            ],
            [
                'title' => 'Ancient Empires',
                'author' => 'Marcus Aurelius (Fictional)',
                'description' => 'The rise and fall of great civilizations.',
                'category_id' => $categoryIds['History'],
                'quantity' => 8,
                'published_year' => 2018,
                'cover_image' => null
            ],
            [
                'title' => 'Coding Future',
                'author' => 'Dev Guru',
                'description' => 'A guide to modern software architecture.',
                'category_id' => $categoryIds['Technology'],
                'quantity' => 10,
                'published_year' => 2024,
                'cover_image' => null
            ],
            [
                'title' => 'Mind and Matter',
                'author' => 'Elena Wise',
                'description' => 'Bridging the gap between physics and consciousness.',
                'category_id' => $categoryIds['Philosophy'],
                'quantity' => 4,
                'published_year' => 2021,
                'cover_image' => null
            ]
        ];

        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}
