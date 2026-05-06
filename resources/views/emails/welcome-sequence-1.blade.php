<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">Selamat Datang! 🕋</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Perjalanan Spiritual Anda Dimulai Di Sini</p>
    </div>

    <div style="background: #ffffff; padding: 30px; border: 1px solid #e1e1e1; border-top: none; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px;">Assalamu'alaikum {{ $lead->name }},</p>

        <p>Terima kasih telah tertarik untuk menunaikan ibadah Umroh bersama kami. Kami sangat menghargai kepercayaan Anda dan berkomitmen untuk membantu mewujudkan perjalanan spiritual yang tak terlupakan.</p>

        <div style="background: #f8f9fa; padding: 20px; border-left: 4px solid #667eea; margin: 25px 0;">
            <h3 style="margin-top: 0; color: #667eea;">📖 Panduan Lengkap Umroh</h3>
            <p style="margin-bottom: 0;">Sebagai hadiah selamat datang, kami telah menyiapkan panduan lengkap yang mencakup:</p>
            <ul style="margin: 15px 0;">
                <li>Persyaratan dokumen & visa</li>
                <li>Panduan ihram & miqat</li>
                <li>Tata cara thawaf & sa'i</li>
                <li>Tempat mustajab untuk berdoa</li>
                <li>Tips praktis selama di Tanah Suci</li>
            </ul>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ config('app.url') }}/packages" 
               style="display: inline-block; background: #667eea; color: white; padding: 15px 40px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">
                Lihat Paket Umroh
            </a>
        </div>

        <p>Dalam email berikutnya, kami akan berbagi tips penting tentang kesalahan umum yang harus dihindari saat merencanakan Umroh.</p>

        <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami:</p>
        
        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 5px 0;">📞 WhatsApp: <a href="https://wa.me/6281234567890" style="color: #667eea;">+62 812-3456-7890</a></p>
            <p style="margin: 5px 0;">📧 Email: info@umroh.com</p>
            <p style="margin: 5px 0;">🌐 Website: <a href="{{ config('app.url') }}" style="color: #667eea;">{{ config('app.url') }}</a></p>
        </div>

        <p style="margin-top: 30px;">Wassalamu'alaikum warahmatullahi wabarakatuh,</p>
        <p><strong>Tim {{ config('app.name') }}</strong></p>

        <hr style="border: none; border-top: 1px solid #e1e1e1; margin: 30px 0;">
        <p style="font-size: 12px; color: #666; text-align: center;">
            Email ini dikirim kepada {{ $lead->email }} karena Anda mendaftar untuk menerima informasi Umroh dari kami.<br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>
    </div>
</body>
</html>
