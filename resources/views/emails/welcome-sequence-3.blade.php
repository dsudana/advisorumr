<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penawaran Spesial</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">🎁 Penawaran Spesial Untuk Anda!</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Konsultasi Umroh GRATIS</p>
    </div>

    <div style="background: #ffffff; padding: 30px; border: 1px solid #e1e1e1; border-top: none; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px;">Assalamu'alaikum {{ $lead->name }},</p>

        <p>Sebagai bentuk apresiasi kami atas ketertarikan Anda pada perjalanan Umroh, kami ingin memberikan penawaran eksklusif:</p>

        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 10px; margin: 25px 0; text-align: center;">
            <h2 style="margin: 0 0 15px 0; font-size: 24px;">🕋 Konsultasi Umroh GRATIS</h2>
            <p style="margin: 0; font-size: 18px; opacity: 0.9;">Senilai Rp 500.000 - Sekarang GRATIS!</p>
        </div>

        <h3 style="color: #667eea;">Apa yang Akan Anda Dapatkan?</h3>
        <ul style="line-height: 2;">
            <li>✅ <strong>Konsultasi Personal</strong> - Diskusi one-on-one dengan expert Umroh</li>
            <li>✅ <strong>Panduan Dokumen Lengkap</strong> - Pastikan semua persyaratan terpenuhi</li>
            <li>✅ <strong>Rekomendasi Paket Terbaik</strong> - Sesuai budget dan kebutuhan Anda</li>
            <li>✅ <strong>Tips & Trik</strong> - Dari jamaah berpengalaman</li>
            <li>✅ <strong>Update Harga Terbaru</strong> - Informasi promo dan diskon spesial</li>
            <li>✅ <strong>Q&A Session</strong> - Jawab semua pertanyaan Anda</li>
        </ul>

        <div style="background: #fffbeb; border: 2px dashed #f59e0b; padding: 20px; border-radius: 10px; margin: 25px 0; text-align: center;">
            <p style="margin: 0 0 15px 0; font-weight: bold; color: #92400e;">⏰ Penawaran Terbatas!</p>
            <p style="margin: 0 0 15px 0;">Konsultasi gratis hanya tersedia untuk <strong>10 pendaftar pertama</strong> minggu ini.</p>
            <p style="margin: 0; font-size: 14px; color: #666;">Sisa slot: <strong style="color: #dc2626;">3 slot lagi</strong></p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20{{ $lead->name }}.%20Saya%20ingin%20klaim%20konsultasi%20gratis." 
               style="display: inline-block; background: #25D366; color: white; padding: 18px 40px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 18px; box-shadow: 0 4px 15px rgba(37,211,102,0.4);">
                📱 Klaim Konsultasi Gratis Sekarang
            </a>
        </div>

        <div style="background: #f0f9ff; padding: 20px; border-radius: 10px; margin: 25px 0;">
            <h4 style="margin-top: 0; color: #0369a1;">💬 Apa Kata Mereka?</h4>
            <div style="font-style: italic; margin-bottom: 15px;">
                "Alhamdulillah, konsultasinya sangat membantu! Timnya ramah, profesional, dan memberikan insight yang tidak saya temukan di tempat lain. Akhirnya saya mantap booking paket Umroh keluarga."
            </div>
            <p style="margin: 0;"><strong>- Ibu Fatimah, Jakarta</strong> ⭐⭐⭐⭐⭐</p>
        </div>

        <p style="margin-top: 30px;">Jangan lewatkan kesempatan emas ini. Klik tombol di atas atau balas email ini untuk menjadwalkan konsultasi Anda.</p>

        <p>Wassalamu'alaikum warahmatullahi wabarakatuh,</p>
        <p><strong>Tim {{ config('app.name') }}</strong></p>

        <hr style="border: none; border-top: 1px solid #e1e1e1; margin: 30px 0;">
        <p style="font-size: 12px; color: #666; text-align: center;">
            Email ini dikirim kepada {{ $lead->email }}<br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
            <a href="{{ config('app.url') }}/unsubscribe?email={{ urlencode($lead->email) }}" style="color: #666;">Unsubscribe</a>
        </p>
    </div>
</body>
</html>
