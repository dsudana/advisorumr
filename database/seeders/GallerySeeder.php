<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        \App\Models\ActivityGallery::truncate();

        $activities = [
            [
                'title' => 'Manasik Haji & Umroh Akbar 2024',
                'description' => 'Kegiatan manasik akbar yang diikuti oleh 500 calon jamaah di Asrama Haji Jakarta. Pembekalan materi dan praktik tawaf serta sa\'i.',
                'image' => 'activity-galleries/manasik-akbar.jpg',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Dummy
                'activity_date' => '2024-12-10',
                'is_published' => true,
            ],
            [
                'title' => 'Keberangkatan Jamaah Paket VIP Desember',
                'description' => 'Pelepasan jamaah paket VIP di Bandara Soekarno Hatta. Semoga menjadi umroh yang mabrur.',
                'image' => 'activity-galleries/departure-vip.jpg',
                'video_url' => null,
                'activity_date' => '2024-12-15',
                'is_published' => true,
            ],
            [
                'title' => 'City Tour Kota Thaif',
                'description' => 'Mengunjungi keindahan Kota Thaif, melihat perkebunan mawar dan menikmati kereta gantung.',
                'image' => 'activity-galleries/thaif-tour.jpg',
                'video_url' => null,
                'activity_date' => '2024-11-20',
                'is_published' => true,
            ],
            [
                'title' => 'Ziarah Ke Jabal Rahmah',
                'description' => 'Mengenang pertemuan Nabi Adam dan Hawa di Jabal Rahmah saat city tour Arafah.',
                'image' => 'activity-galleries/jabal-rahmah.jpg',
                'video_url' => null,
                'activity_date' => '2024-11-22',
                'is_published' => true,
            ],
            [
                'title' => 'Kajian Rutin di Masjid Nabawi',
                'description' => 'Jamaah mengikuti kajian rutin ba\'da Ashar di pelataran Masjid Nabawi bersama Ustadz fulan.',
                'image' => 'activity-galleries/kajian-nabawi.jpg',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'activity_date' => '2024-11-25',
                'is_published' => true,
            ],
            [
                'title' => 'Kedatangan Jamaah di Tanah Air',
                'description' => 'Alhamdulillah seluruh jamaah telah mendarat kembali di Jakarta dengan selamat. Disambut tangis haru keluarga.',
                'image' => 'activity-galleries/arrival-indo.jpg',
                'video_url' => null,
                'activity_date' => '2024-12-01',
                'is_published' => true,
            ],
        ];

        foreach ($activities as $activity) {
            \App\Models\ActivityGallery::create($activity);
        }
    }
}
