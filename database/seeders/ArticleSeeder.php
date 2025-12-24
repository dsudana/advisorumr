<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have a user
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
        }

        // Create Categories
        $categories = [
            ['name' => 'Tips Umroh', 'slug' => 'tips-umroh', 'description' => 'Berbagai tips bermanfaat untuk persiapan dan pelaksanaan ibadah Umroh.'],
            ['name' => 'Berita Terkini', 'slug' => 'berita-terkini', 'description' => 'Update berita terbaru seputar dunia travel dan haji umroh.'],
            ['name' => 'Paket Promo', 'slug' => 'paket-promo', 'description' => 'Informasi paket promo menarik untuk perjalanan ibadah Anda.'],
            ['name' => 'Kisah Inspiratif', 'slug' => 'kisah-inspiratif', 'description' => 'Kumpulan kisah inspiratif dari para jamaah.'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }

        // Create Tags
        $tags = ['Hemat', 'VIP', 'Ramadhan', 'Syawal', 'Keluarga', 'Solo Traveler'];
        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );
        }

        // Get all categories and tags for random assignment
        $allCategories = Category::all();
        $allTags = Tag::all();

        // Create 6 Articles
        $articlesData = [
            [
                'title' => '5 Tips Persiapan Fisik Sebelum Umroh',
                'slug' => '5-tips-persiapan-fisik-sebelum-umroh',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            ],
            [
                'title' => 'Keutamaan Melaksanakan Umroh di Bulan Ramadhan',
                'slug' => 'keutamaan-melaksanakan-umroh-di-bulan-ramadhan',
                'content' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
            [
                'title' => 'Panduan Memilih Travel Umroh Terpercaya',
                'slug' => 'panduan-memilih-travel-umroh-terpercaya',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
            ],
            [
                'title' => 'Barang Bawaan Wajib Saat Umroh',
                'slug' => 'barang-bawaan-wajib-saat-umroh',
                'content' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.',
            ],
            [
                'title' => 'Menikmati Kota Madinah Setelah Beribadah',
                'slug' => 'menikmati-kota-madinah-setelah-beribadah',
                'content' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',
            ],
        ];

        foreach ($articlesData as $data) {
            $article = Article::firstOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'user_id' => $user->id,
                    'category_id' => $allCategories->random()->id,
                    'status' => 'published',
                    'published_at' => now(),
                    // You might want to provide a placeholder image or similar
                    'image' => null,
                ])
            );

            // Attach 1 to 3 random tags
            $article->tags()->sync($allTags->random(rand(1, 3))->pluck('id'));
        }
    }
}
