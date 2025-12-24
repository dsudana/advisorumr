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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@travel.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@travel.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Create 10 more random customers
        User::factory(10)->create([
            'role' => 'customer',
        ]);

        $this->call([
            PackageSeeder::class,
            TestimonialSeeder::class,
            SiteSettingSeeder::class,
            GallerySeeder::class,
            BookingSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
