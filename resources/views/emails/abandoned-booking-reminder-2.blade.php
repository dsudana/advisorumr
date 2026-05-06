<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waktu Terbatas</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 28px;">⏰ Waktu Terbatas!</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Paket Umroh Anda Menunggu</p>
    </div>

    <div style="background: #ffffff; padding: 30px; border: 1px solid #e1e1e1; border-top: none; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px;">Assalamu'alaikum {{ $booking->name ?? 'Jamaah yang Mulia' }},</p>

        <div style="background: #fef3c7; border: 2px solid #f59e0b; border-radius: 10px; padding: 20px; text-align: center; margin: 25px 0;">
            <p style="margin: 0; font-size: 18px; font-weight: bold; color: #92400e;">🔔 Pengingat: Reservasi Anda Belum Selesai</p>
            <p style="margin: 10px 0 0 0; font-size: 14px;">Kami telah menyimpan reservasi Anda selama beberapa jam terakhir.</p>
        </div>

        <p>Kami ingin mengingatkan bahwa paket Umroh yang Anda pilih masih menunggu konfirmasi pembayaran. Namun, ketersediaan kursi tidak dapat kami jamin dalam waktu lama.</p>

        <div style="background: #f8f9fa; border-radius: 10px; padding: 20px; margin: 25px 0;">
            <h3 style="margin-top: 0; color: #667eea;">📦 Ringkasan Reservasi</h3>
            <p><strong>Paket:</strong> {{ $booking->package->name ?? 'Paket Umroh' }}</p>
            <p><strong>Kode Booking:</strong> {{ $booking->booking_code }}</p>
            <p><strong>Total:</strong> <span style="font-size: 20px; font-weight: bold; color: #667eea;">Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</span></p>
        </div>

        <div style="background: #fee2e2; border-left: 4px solid #dc2626; padding: 15px; margin: 25px 0;">
            <p style="margin: 0;"><strong>⚠️ PERHATIAN:</strong> Beberapa paket dengan tanggal keberangkatan serupa sudah hampir penuh. Segera selesaikan pembayaran untuk menghindari kehabisan kursi.</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ config('app.url') }}/bookings/{{ $booking->booking_code }}" 
               style="display: inline-block; background: #dc2626; color: white; padding: 18px 40px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 15px rgba(220,38,38,0.4);">
                🔒 Amankan Kursi Anda Sekarang
            </a>
        </div>

        <div style="background: #ecfdf5; padding: 20px; border-radius: 10px; margin: 25px 0;">
            <h4 style="margin-top: 0; color: #059669;">💳 Metode Pembayaran Tersedia</h4>
            <ul style="line-height: 2; margin-bottom: 0;">
                <li>✅ Transfer Bank (BCA, Mandiri, BNI, BRI)</li>
                <li>✅ Virtual Account</li>
                <li>✅ Kartu Kredit/Debit</li>
                <li>✅ E-Wallet (GoPay, OVO, Dana, ShopeePay)</li>
                <li>✅ Cicilan 0% (syarat & ketentuan berlaku)</li>
            </ul>
        </div>

        <p style="margin-top: 25px;">Jika Anda mengalami kendala dalam pembayaran atau memiliki pertanyaan, tim kami siap membantu 24/7:</p>
        
        <div style="text-align: center; margin: 20px 0;">
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20butuh%20bantuan%20pembayaran%20booking%20{{ $booking->booking_code }}" 
               style="display: inline-block; background: #25D366; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                💬 Chat WhatsApp
            </a>
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
