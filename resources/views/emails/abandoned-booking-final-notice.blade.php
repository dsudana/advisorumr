<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Terakhir</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">🔴 PEMBERITAHUAN TERAKHIR</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Reservasi Anda Akan Kadaluarsa</p>
    </div>

    <div style="background: #ffffff; padding: 30px; border: 1px solid #e1e1e1; border-top: none; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px;">Assalamu'alaikum {{ $booking->name ?? 'Jamaah yang Mulia' }},</p>

        <div style="background: #fee2e2; border: 3px solid #dc2626; border-radius: 10px; padding: 25px; text-align: center; margin: 25px 0;">
            <p style="margin: 0; font-size: 22px; font-weight: bold; color: #991b1b;">⚠️ RESERVASI ANDA AKAN KADALUARSA</p>
            <p style="margin: 15px 0 0 0; font-size: 16px;">Ini adalah pemberitahuan terakhir sebelum reservasi Anda dibatalkan secara otomatis.</p>
        </div>

        <p>Dengan berat hati kami informasikan bahwa jika pembayaran tidak diterima dalam waktu <strong>24 jam</strong>, reservasi Anda akan dibatalkan dan kursi akan ditawarkan kepada jamaah lain.</p>

        <div style="background: #f8f9fa; border-radius: 10px; padding: 20px; margin: 25px 0;">
            <h3 style="margin-top: 0; color: #667eea;">📦 Detail Reservasi</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1;"><strong>Kode Booking:</strong></td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1; text-align: right; font-family: monospace; font-size: 16px;">{{ $booking->booking_code }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1;"><strong>Paket:</strong></td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1; text-align: right;">{{ $booking->package->name ?? 'Paket Umroh' }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1;"><strong>Tanggal Keberangkatan:</strong></td>
                    <td style="padding: 10px 0; border-bottom: 1px solid #e1e1e1; text-align: right;">{{ $booking->departure_date ?? 'Akan dikonfirmasi' }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;"><strong>Total Harga:</strong></td>
                    <td style="padding: 10px 0; text-align: right; font-weight: bold; color: #dc2626; font-size: 20px;">
                        Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>

        <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 25px 0;">
            <p style="margin: 0;"><strong>💡 TAHUKAH ANDA?</strong> Setelah kadaluarsa, Anda harus melakukan pemesanan ulang dengan harga yang berlaku saat itu (dapat terjadi kenaikan).</p>
        </div>

        <div style="text-align: center; margin: 35px 0;">
            <a href="{{ config('app.url') }}/bookings/{{ $booking->booking_code }}" 
               style="display: inline-block; background: #dc2626; color: white; padding: 20px 50px; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 18px; box-shadow: 0 6px 20px rgba(220,38,38,0.5); animation: pulse 2s infinite;">
                🚨 BAYAR SEKARANG JUGA
            </a>
        </div>

        <style>
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        </style>

        <div style="background: #f0f9ff; padding: 20px; border-radius: 10px; margin: 25px 0;">
            <h4 style="margin-top: 0; color: #0369a1;">🆘 Butuh Bantuan Segera?</h4>
            <p style="margin: 10px 0;">Hubungi tim kami untuk bantuan pembayaran instan:</p>
            <p style="margin: 10px 0;">📞 <strong>Telepon:</strong> <a href="tel:+6281234567890" style="color: #667eea;">+62 812-3456-7890</a></p>
            <p style="margin: 10px 0;">💬 <strong>WhatsApp:</strong> <a href="https://wa.me/6281234567890?text=DARURAT:%20Saya%20butuh%20bantuan%20pembayaran%20booking%20{{ $booking->booking_code }}" style="color: #667eea;">Klik di sini</a></p>
            <p style="margin: 10px 0;">📧 <strong>Email:</strong> urgent@umroh.com</p>
        </div>

        <hr style="border: none; border-top: 2px dashed #e1e1e1; margin: 30px 0;">

        <p style="font-size: 14px; color: #666;"><strong>Catatan:</strong> Email ini dikirim sebagai upaya terakhir untuk mengingatkan Anda tentang reservasi yang belum diselesaikan. Jika Anda sudah melakukan pembayaran, abaikan email ini dan terima kasih atas kepercayaan Anda.</p>

        <p style="margin-top: 30px;">Kami sangat berharap dapat melayani Anda dalam perjalanan spiritual ini.</p>

        <p>Wassalamu'alaikum warahmatullahi wabarakatuh,</p>
        <p><strong>Tim {{ config('app.name') }}</strong></p>

        <hr style="border: none; border-top: 1px solid #e1e1e1; margin: 30px 0;">
        <p style="font-size: 12px; color: #666; text-align: center;">
            Kode Booking: {{ $booking->booking_code }}<br>
            Dikirim pada: {{ now()->format('d F Y, H:i') }} WIB<br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>
    </div>
</body>
</html>
