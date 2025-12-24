<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Testimonial::truncate();

        $testimonials = [
            [
                'name' => 'H. Ahmad Dahlan',
                'position' => 'Jamaah Umroh April 2025',
                'content' => 'Alhamdulillah, perjalanan umroh bersama travel ini sangat memuaskan. Pelayanan prima, hotel dekat dengan Masjidil Haram, dan muthawifnya sangat berilmu. Sangat direkomendasikan!',
                'rating' => 5,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Siti Aminah',
                'position' => 'Jamaah Ramadhan 2024',
                'content' => 'Masya Allah, pengalaman yang tak terlupakan. Fasilitas yang diberikan sesuai dengan yang dijanjikan. Pembimbing ibadahnya sangat sabar membimbing kami para lansia. Terima kasih banyak.',
                'rating' => 5,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Budi Santoso',
                'position' => 'Jamaah Paket VIP',
                'content' => 'Harga paket sangat kompetitif dengan fasilitas bintang 5. Proses administrasi cepat dan transparan. Insya Allah tahun depan akan berangkat lagi bersama keluarga menggunakan jasa travel ini.',
                'rating' => 4,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Dr. Faridah',
                'position' => 'Jamaah Umroh Plus Turki',
                'content' => 'Travel umroh terpercaya dan amanah. Jadwal kegiatan teratur namun tidak melelahkan. Makanannya juga enak-enak, cocok dengan lidah orang Indonesia. Sukses terus untuk travel ini.',
                'rating' => 5,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Rizky Pratama',
                'position' => 'Jamaah Backpacker 2024',
                'content' => 'Perjalanan umroh pertama saya dan sangat berkesan. Tim handling di bandara sangat cekatan. Bus AC nya dingin dan nyaman. Recommended banget buat anak muda yang mau umroh backpacker tapi fasilitas VIP.',
                'rating' => 5,
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::create($testimonial);
        }
    }
}
