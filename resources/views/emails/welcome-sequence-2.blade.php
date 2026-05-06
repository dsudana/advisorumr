<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tips Umroh</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">⚠️ 5 Kesalahan Umum Umroh</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Dan Cara Menghindarinya</p>
    </div>

    <div style="background: #ffffff; padding: 30px; border: 1px solid #e1e1e1; border-top: none; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px;">Assalamu'alaikum {{ $lead->name }},</p>

        <p>Berdasarkan pengalaman kami melayani ribuan jamaah, berikut adalah 5 kesalahan umum yang sering dilakukan dan bagaimana Anda bisa menghindarinya:</p>

        <div style="margin: 25px 0;">
            <div style="background: #fff5f5; border-left: 4px solid #f5576c; padding: 15px; margin-bottom: 15px;">
                <h4 style="margin: 0 0 10px 0; color: #f5576c;">❌ Kesalahan #1: Tidak Memahami Miqat</h4>
                <p style="margin: 0;"><strong>Solusi:</strong> Pelajari lokasi miqat sesuai rute penerbangan Anda. Ihram harus dilakukan di miqat, bukan di pesawat atau setelah sampai Makkah.</p>
            </div>

            <div style="background: #fff5f5; border-left: 4px solid #f5576c; padding: 15px; margin-bottom: 15px;">
                <h4 style="margin: 0 0 10px 0; color: #f5576c;">❌ Kesalahan #2: Terlalu Banyak Bawaan</h4>
                <p style="margin: 0;"><strong>Solusi:</strong> Bawa pakaian sederhana. Di Tanah Suci Anda akan lebih banyak memakai pakaian ihram. Fokus pada kebutuhan ibadah, bukan fashion.</p>
            </div>

            <div style="background: #fff5f5; border-left: 4px solid #f5576c; padding: 15px; margin-bottom: 15px;">
                <h4 style="margin: 0 0 10px 0; color: #f5576c;">❌ Kesalahan #3: Tidak Mencatat Doa-doa Penting</h4>
                <p style="margin: 0;"><strong>Solusi:</strong> Siapkan buku kecil atau aplikasi doa di HP. Catat doa untuk thawaf, sa'i, dan saat di Multazam agar tidak lupa.</p>
            </div>

            <div style="background: #fff5f5; border-left: 4px solid #f5576c; padding: 15px; margin-bottom: 15px;">
                <h4 style="margin: 0 0 10px 0; color: #f5576c;">❌ Kesalahan #4: Mengabaikan Kesehatan</h4>
                <p style="margin: 0;"><strong>Solusi:</strong> Bawa obat pribadi, vitamin, dan masker. Cuaca berbeda dapat mempengaruhi kondisi tubuh. Jaga stamina dengan istirahat cukup.</p>
            </div>

            <div style="background: #fff5f5; border-left: 4px solid #f5576c; padding: 15px; margin-bottom: 15px;">
                <h4 style="margin: 0 0 10px 0; color: #f5576c;">❌ Kesalahan #5: Tidak Memilih Travel Terpercaya</h4>
                <p style="margin: 0;"><strong>Solusi:</strong> Pastikan travel memiliki izin resmi Kemenag, pengalaman yang terbukti, dan layanan purna jual yang baik.</p>
            </div>
        </div>

        <div style="background: #f0fdf4; padding: 20px; border-radius: 5px; margin: 25px 0; text-align: center;">
            <h3 style="margin-top: 0; color: #16a34a;">✅ Bonus Tips!</h3>
            <p style="margin-bottom: 15px;">Download checklist lengkap persiapan Umroh gratis di bawah ini:</p>
            <a href="{{ config('app.url') }}/download/checklist-umroh" 
               style="display: inline-block; background: #16a34a; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                📥 Download Checklist Gratis
            </a>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <p style="margin-bottom: 15px;">Ingin konsultasi langsung dengan tim kami?</p>
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20konsultasi%20Umroh" 
               style="display: inline-block; background: #25D366; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                💬 Chat WhatsApp Sekarang
            </a>
        </div>

        <p style="margin-top: 30px;">Di email berikutnya, kami akan mengirimkan penawaran spesial konsultasi gratis untuk Anda.</p>

        <p>Wassalamu'alaikum warahmatullahi wabarakatuh,</p>
        <p><strong>Tim {{ config('app.name') }}</strong></p>

        <hr style="border: none; border-top: 1px solid #e1e1e1; margin: 30px 0;">
        <p style="font-size: 12px; color: #666; text-align: center;">
            Email ini dikirim kepada {{ $lead->email }}<br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>
    </div>
</body>
</html>
