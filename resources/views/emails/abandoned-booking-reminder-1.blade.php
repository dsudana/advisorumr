<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Reservasi Anda</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">🕋 Lengkapi Reservasi Umroh Anda</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Paket Anda Masih Tersedia</p>
    </div>

    <div style="background: #ffffff; padding: 30px; border: 1px solid #e1e1e1; border-top: none; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px;">Assalamu'alaikum {{ $booking->name ?? 'Jamaah yang Mulia' }},</p>

        <p>Kami注意到 Anda telah memulai proses reservasi Umroh namun belum menyelesaikannya. Jangan khawatir, paket yang Anda pilih masih tersedia!</p>

        <div style="background: #f8f9fa; border: 2px solid #667eea; border-radius: 10px; padding: 20px; margin: 25px 0;">
            <h3 style="margin-top: 0; color: #667eea;">📦 Detail Reservasi Anda</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1;"><strong>Paket:</strong></td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1; text-align: right;">{{ $booking->package->name ?? 'Paket Umroh' }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1;"><strong>Tanggal Keberangkatan:</strong></td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1; text-align: right;">{{ $booking->departure_date ?? 'Akan dikonfirmasi' }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1;"><strong>Jumlah Jamaah:</strong></td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1; text-align: right;">{{ $booking->passengers_count ?? '-' }} Orang</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Total Harga:</strong></td>
                    <td style="padding: 10px 0; text-align: right; font-weight: bold; color: #667eea; font-size: 18px;">
                        Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>

        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 25px 0;">
            <p style="margin: 0;"><strong>⚠️ Penting:</strong> Harga dan ketersediaan paket dapat berubah sewaktu-waktu. Selesaikan pembayaran Anda untuk mengunci harga ini.</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ config('app.url') }}/bookings/{{ $booking->booking_code }}" 
               style="display: inline-block; background: #667eea; color: white; padding: 18px 40px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                ✅ Lanjutkan Pembayaran Sekarang
            </a>
        </div>

        <p style="margin-top: 25px;"><strong>Kenapa harus melengkapi sekarang?</strong></p>
        <ul style="line-height: 2;">
            <li>✅ Kursi masih tersedia untuk tanggal pilihan Anda</li>
            <li>✅ Harga masih sama (belum ada kenaikan)</li>
            <li>✅ Proses lebih cepat karena data sudah terisi</li>
            <li>✅ Bisa langsung dapat nomor seat pilihan</li>
        </ul>

        <div style="background: #f0f9ff; padding: 20px; border-radius: 10px; margin: 25px 0;">
            <h4 style="margin-top: 0; color: #0369a1;">💡 Butuh Bantuan?</h4>
            <p style="margin: 10px 0;">Tim kami siap membantu Anda menyelesaikan reservasi:</p>
            <p style="margin: 5px 0;">📞 WhatsApp: <a href="https://wa.me/6281234567890" style="color: #667eea;">+62 812-3456-7890</a></p>
            <p style="margin: 5px 0;">📧 Email: support@umroh.com</p>
        </div>

        <p>Wassalamu'alaikum warahmatullahi wabarakatuh,</p>
        <p><strong>Tim {{ config('app.name') }}</strong></p>

        <hr style="border: none; border-top: 1px solid #e1e1e1; margin: 30px 0;">
        <p style="font-size: 12px; color: #666; text-align: center;">
            Kode Booking: {{ $booking->booking_code }}<br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>
    </div>
</body>
</html>
