<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ----------------------------
        // Admins Table Seeding
        // ----------------------------
        DB::table('admins')->insert([
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'admin@example.com',
                'mobile' => '9999999999',
                'password' => 'password123', // Plain password (if needed)
                'Hash_password' => Hash::make('password123'),
                'status' => 1,
                'role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ----------------------------
        // Contacts Table Seeding
        // ----------------------------
        DB::table('contacts')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'mobile' => '+91-9876543210',
                'message' => 'This is a sample contact message.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'mobile' => '+91-9123456789',
                'message' => 'Another contact form entry.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ----------------------------
        // Blogs Table Seeding
        // ----------------------------
        DB::table('blogs')->insert([
            [
                'title' => 'Getting Started with Laravel',
                'slug' => 'getting-started-with-laravel',
                'content' => 'This is a sample blog post about Laravel basics.',
                'featured_image' => null,
                'status' => 'published',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced Laravel Tips',
                'slug' => 'advanced-laravel-tips',
                'content' => 'This blog post provides advanced tips for Laravel developers.',
                'featured_image' => null,
                'status' => 'draft',
                'published_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
