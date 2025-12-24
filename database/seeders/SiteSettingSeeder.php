<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Umroh Travel',
            'site_description' => 'Platform perjalanan ibadah umroh terpercaya dengan pelayanan terbaik dan fasilitas premium.',
            'contact_phone' => '+62 812 3456 7890',
            'contact_email' => 'info@umrohtravel.com',
            'address' => 'Jl. Jendral Sudirman No. 123, Jakarta Selatan, Indonesia',
            'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2736171923485!2d106.80164227581172!3d-6.227616993760447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d808e0859%3A0x6bba46df3c6df5d6!2sJl.%20Jend.%20Sudirman%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1703403000000!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'facebook_url' => 'https://facebook.com/umrohtravel',
            'instagram_url' => 'https://instagram.com/umrohtravel',
            'tiktok_url' => 'https://tiktok.com/@umrohtravel',
            'twitter_url' => 'https://twitter.com/umrohtravel',
            'youtube_url' => 'https://youtube.com/umrohtravel',
        ]);
    }
}
