<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    public function run()
    {
        // 1. Umroh Reguler 9 Days
        $reguler = Package::create([
            'name' => 'Umroh Reguler 9 Hari',
            'slug' => 'umroh-reguler-9-hari',
            'category' => 'reguler',
            'airline' => 'Saudia Airlines',
            'short_description' => 'Paket Umroh hemat dengan fasilitas nyaman selama 9 hari perjalanan.',
            'description' => '<p>Nikmati ibadah Umroh yang khusyuk dengan harga terjangkau. Paket ini mencakup akomodasi hotel bintang 4 yang dekat dengan Masjidil Haram dan Masjid Nabawi.</p>',
            'price' => 28500000,
            'discount_price' => 0,
            'departure_date' => Carbon::parse('2025-02-15'),
            'return_date' => Carbon::parse('2025-02-23'),
            'duration_days' => 9,
            'total_seats' => 45,
            'available_seats' => 42,
            'makkah_hotel_name' => 'Rayyana Hotel',
            'makkah_hotel_stars' => 4,
            'madinah_hotel_name' => 'Rawda Royal Inn',
            'madinah_hotel_stars' => 4,
            'status' => 'published',
            'is_featured' => true,
        ]);

        $reguler->facilities()->createMany([
            ['facility' => 'Tiket Pesawat PP', 'icon' => 'plane'],
            ['facility' => 'Hotel Bintang 4', 'icon' => 'building'],
            ['facility' => 'Makan 3x Sehari', 'icon' => 'utensils'],
            ['facility' => 'Visa Umroh', 'icon' => 'passport'],
            ['facility' => 'Muthawif Berpengalaman', 'icon' => 'user'],
            ['facility' => 'Transportasi Bus AC', 'icon' => 'bus'],
        ]);

        $reguler->itineraries()->createMany([
            ['day' => 1, 'title' => 'Jakarta - Jeddah - Madinah', 'description' => 'Berkumpul di Bandara Soekarno Hatta, penerbangan menuju Jeddah, dilanjutkan perjalanan ke Madinah.'],
            ['day' => 2, 'title' => 'Ziarah Raudhah', 'description' => 'Memperbanyak ibadah di Masjid Nabawi dan ziarah ke Raudhah.'],
            ['day' => 3, 'title' => 'Ziarah Kota Madinah', 'description' => 'Mengunjungi Masjid Quba, Kebun Kurma, dan Jannatul Baqi.'],
            ['day' => 4, 'title' => 'Madinah - Makkah', 'description' => 'Mengambil Miqat, perjalanan ke Makkah, dan melaksanakan Umroh pertama.'],
            ['day' => 5, 'title' => 'Ibadah di Makkah', 'description' => 'Memperbanyak ibadah di Masjidil Haram.'],
            ['day' => 6, 'title' => 'Ziarah Kota Makkah', 'description' => 'Mengunjungi Jabal Tsur, Jabal Rahmah, dan Arafah.'],
            ['day' => 7, 'title' => 'Ibadah Bebas', 'description' => 'Hari bebas untuk beribadah atau berbelanja oleh-oleh.'],
            ['day' => 8, 'title' => 'Makkah - Jeddah - Jakarta', 'description' => 'Thawaf Wada, perjalanan ke Jeddah, city tour Jeddah, dan penerbangan kembali ke Jakarta.'],
            ['day' => 9, 'title' => 'Tiba di Jakarta', 'description' => 'Tiba di Bandara Soekarno Hatta. Semoga menjadi Umroh yang Mabrur.'],
        ]);

        // 2. Umroh Plus Turkey 12 Days
        $plus = Package::create([
            'name' => 'Umroh Plus Turkey 12 Hari',
            'slug' => 'umroh-plus-turkey-12-hari',
            'category' => 'plus',
            'airline' => 'Turkish Airlines',
            'short_description' => 'Gabungan ibadah Umroh dan wisata sejarah ke Istanbul, Turki.',
            'description' => '<p>Paket spesial bagi Anda yang ingin beribadah sekaligus tadabbur alam dan sejarah di negeri dua benua, Turki. Mengunjungi Blue Mosque, Hagia Sophia, dan tempat bersejarah lainnya.</p>',
            'price' => 35000000,
            'discount_price' => 33500000,
            'departure_date' => Carbon::parse('2025-03-10'),
            'return_date' => Carbon::parse('2025-03-21'),
            'duration_days' => 12,
            'total_seats' => 30,
            'available_seats' => 15,
            'makkah_hotel_name' => 'Swissotel Makkah',
            'makkah_hotel_stars' => 5,
            'madinah_hotel_name' => 'Anwar Movenpick',
            'madinah_hotel_stars' => 5,
            'status' => 'published',
            'is_featured' => true,
        ]);

        $plus->facilities()->createMany([
            ['facility' => 'Tiket Pesawat PP', 'icon' => 'plane'],
            ['facility' => 'Hotel Bintang 5', 'icon' => 'building'],
            ['facility' => 'Tour Turki 3 Hari', 'icon' => 'map-marked'],
            ['facility' => 'Makan Fullboard', 'icon' => 'utensils'],
            ['facility' => 'Visa Umroh & Turki', 'icon' => 'passport'],
        ]);

        $plus->itineraries()->createMany([
            ['day' => 1, 'title' => 'Jakarta - Istanbul', 'description' => 'Penerbangan menuju Istanbul, Turki.'],
            ['day' => 2, 'title' => 'City Tour Istanbul', 'description' => 'Mengunjungi Blue Mosque, Hagia Sophia, dan Topkapi Palace.'],
            ['day' => 3, 'title' => 'Bosphorus Cruise', 'description' => 'Menikmati pemandangan selat Bosphorus dan belanja di Grand Bazaar.'],
            ['day' => 4, 'title' => 'Istanbul - Madinah', 'description' => 'Penerbangan menuju Madinah Al Munawwarah.'],
            ['day' => 5, 'title' => 'Ziarah Madinah', 'description' => 'Ibadah di Masjid Nabawi dan Ziarah Raudhah.'],
            // ... (simplified for brevity)
            ['day' => 12, 'title' => 'Tiba di Jakarta', 'description' => 'Tiba kembali di tanah air.'],
        ]);

        // 3. Umroh VIP Ramadhan
        $vip = Package::create([
            'name' => 'Umroh VIP Akhir Ramadhan',
            'slug' => 'umroh-vip-ramadhan',
            'category' => 'vip',
            'airline' => 'Garuda Indonesia',
            'short_description' => 'Raih pahala Lailatul Qadar di Tanah Suci dengan fasilitas VVIP.',
            'description' => '<p>Paket eksklusif 10 hari terakhir Ramadhan. Menginap di Zamzam Tower yang berhadapan langsung dengan Ka\'bah. Fasilitas premium untuk kenyamanan ibadah Anda.</p>',
            'price' => 45000000,
            'discount_price' => 0,
            'departure_date' => Carbon::parse('2025-03-20'), // Approximate Ramadhan date
            'return_date' => Carbon::parse('2025-03-30'),
            'duration_days' => 10,
            'total_seats' => 20,
            'available_seats' => 5,
            'makkah_hotel_name' => 'Pullman Zamzam',
            'makkah_hotel_stars' => 5,
            'madinah_hotel_name' => 'Oberoi Madinah',
            'madinah_hotel_stars' => 5,
            'status' => 'published',
            'is_featured' => true,
        ]);

        $vip->facilities()->createMany([
            ['facility' => 'Direct Flight Garuda', 'icon' => 'plane'],
            ['facility' => 'Hotel Depan Haram', 'icon' => 'hotel'],
            ['facility' => 'Menu Berbuka & Sahur Premium', 'icon' => 'utensils'],
            ['facility' => 'Handling VIP', 'icon' => 'star'],
        ]);

        $vip->itineraries()->createMany([
            ['day' => 1, 'title' => 'Jakarta - Jeddah - Makkah', 'description' => 'Direct flight to Jeddah, langsung menuju Makkah untuk Umroh.'],
            ['day' => 2, 'title' => 'Ibadah Ramadhan', 'description' => 'Fokus ibadah, Qiyamul Lail, dan Itikaf.'],
            ['day' => 10, 'title' => 'Jakarta', 'description' => 'Tiba di Jakarta.'],
        ]);
    }
}
