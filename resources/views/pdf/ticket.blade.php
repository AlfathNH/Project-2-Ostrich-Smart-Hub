<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket Ostrich Smart Hub</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .ticket-wrapper {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #ddd;
            overflow: hidden;
        }
        .ticket-header {
            background-color: #FFD700;
            color: #1a1a1a;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 2px dashed #1a1a1a;
        }
        .ticket-header h1 {
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .ticket-header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.8;
        }
        .ticket-body {
            padding: 30px;
        }
        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-grid td {
            padding: 10px 0;
            vertical-align: top;
        }
        .label {
            font-size: 11px;
            text-transform: uppercase;
            color: #777;
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
        }
        .value {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
        }
        .ticket-footer {
            background: #1a1a1a;
            color: #FFD700;
            text-align: center;
            padding: 15px;
            font-size: 12px;
        }
        .barcode-area {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }
        .qr-placeholder {
            display: inline-block;
            width: 150px;
            height: 150px;
            background: #eee;
            border: 2px solid #ccc;
            line-height: 150px;
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="ticket-wrapper">
        <div class="ticket-header">
            <h1>Ostrich Mini Zoo</h1>
            <p>E-Ticket Resmi Kunjungan</p>
        </div>
        
        <div class="ticket-body">
            <table class="info-grid">
                <tr>
                    <td width="60%">
                        <span class="label">Nama Pengunjung</span>
                        <span class="value">{{ $order->nama_pemesan }}</span>
                    </td>
                    <td width="40%">
                        <span class="label">Tanggal Kunjungan</span>
                        <span class="value" style="color: #059669;">{{ \Carbon\Carbon::parse($order->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Nomor WhatsApp</span>
                        <span class="value">{{ $order->phone }}</span>
                    </td>
                    <td>
                        <span class="label">Jumlah Tiket</span>
                        <span class="value">{{ $order->jumlah_tiket }} Orang</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Metode Pembayaran</span>
                        <span class="value" style="text-transform: uppercase;">{{ $order->metode_bayar }}</span>
                    </td>
                    <td>
                        <span class="label">Total Pembayaran</span>
                        <span class="value text-emerald">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                    </td>
                </tr>
            </table>

            <div class="barcode-area">
                <span class="label" style="text-align: center;">KODE BOOKING ANDA</span>
                <div style="font-size: 24px; font-weight: 900; letter-spacing: 4px; font-family: monospace; color: #1a1a1a;">
                    {{ $order->kode_booking }}
                </div>
                <div style="margin-top: 15px; font-size: 11px; color: #666; max-width: 80%; margin-left: auto; margin-right: auto;">
                    Harap tunjukkan e-ticket ini atau sebutkan kode booking kepada Zookeeper/Petugas di pintu masuk. Bukti ini sah dan diterbitkan secara digital.
                </div>
            </div>
        </div>
        
        <div class="ticket-footer">
            &copy; {{ date('Y') }} Ostrich Mini Zoo Subang. Hak cipta dilindungi.
        </div>
    </div>

</body>
</html>
