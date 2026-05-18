<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan — Ostrich Mini Zoo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', Arial, sans-serif; font-size: 11px; color: #1a1a1a; background: #f0f2f5; }

        /* ===== WRAPPER ===== */
        .page-wrapper { max-width: 1040px; margin: 24px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 32px rgba(0,0,0,0.10); }

        /* ===== HEADER ===== */
        .report-header { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%); color:#fff; padding: 28px 32px 22px; position:relative; overflow:hidden; }
        .report-header::before { content:''; position:absolute; top:-50px; right:-50px; width:220px; height:220px; background:radial-gradient(circle, rgba(255,215,0,0.12) 0%, transparent 70%); border-radius:50%; }
        .header-top { display:flex; align-items:flex-start; justify-content:space-between; gap:20px; }
        .header-logo { display:flex; align-items:center; gap:14px; }
        .logo-icon { width:52px; height:52px; background:linear-gradient(135deg,#FFD700,#c9a800); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:26px; flex-shrink:0; box-shadow:0 4px 12px rgba(255,215,0,0.3); }
        .logo-text h1 { font-size:18px; font-weight:800; color:#FFD700; letter-spacing:-0.3px; line-height:1.2; }
        .logo-text p { font-size:10.5px; color:rgba(255,255,255,0.5); margin-top:2px; }
        .header-meta { text-align:right; }
        .header-meta .doc-title { font-size:14px; font-weight:800; color:#FFD700; margin-bottom:4px; }
        .header-meta .doc-info { font-size:10px; color:rgba(255,255,255,0.5); line-height:1.8; }
        .header-stats { margin-top:18px; border-top:1px solid rgba(255,215,0,0.2); padding-top:16px; display:flex; gap:28px; flex-wrap:wrap; }
        .hstat { display:flex; flex-direction:column; gap:2px; }
        .hstat .hl { font-size:9px; color:rgba(255,255,255,0.4); text-transform:uppercase; letter-spacing:0.8px; font-weight:600; }
        .hstat .hv { font-size:14px; font-weight:800; color:#fff; }
        .hstat .hv.gold { color:#FFD700; }
        .hstat .hv.green { color:#6ee7b7; }
        .hstat .hv.red { color:#fca5a5; }

        /* ===== FILTER BAR (screen only) ===== */
        .filter-bar { background:#f8fafc; border-bottom:1px solid #e5e7eb; padding:14px 32px; display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
        .filter-bar label { font-size:11px; font-weight:700; color:#374151; }
        .filter-bar select { font-family:'Inter',sans-serif; font-size:11px; padding:6px 10px; border:1px solid #d1d5db; border-radius:7px; background:#fff; color:#111; outline:none; cursor:pointer; }
        .filter-bar select:focus { border-color:#FFD700; }
        .btn-f { padding:7px 14px; border-radius:7px; border:none; font-family:'Inter',sans-serif; font-size:11px; font-weight:700; cursor:pointer; transition:all 0.15s; }
        .btn-apply { background:linear-gradient(135deg,#FFD700,#c9a800); color:#1a1a1a; }
        .btn-apply:hover { opacity:0.9; }
        .btn-print { background:#1a1a2e; color:#FFD700; display:flex; align-items:center; gap:6px; }
        .btn-print:hover { background:#16213e; }
        .btn-back  { background:transparent; color:#6b7280; border:1px solid #d1d5db; }
        .btn-back:hover { background:#f3f4f6; }
        .spacer { flex:1; }

        /* ===== SUMMARY CARDS ===== */
        .summary-section { padding:20px 32px 14px; display:grid; grid-template-columns:repeat(4,1fr); gap:12px; }
        .scard { border-radius:10px; padding:14px 16px; border:1px solid transparent; }
        .scard.income    { background:#f0fdf4; border-color:#bbf7d0; }
        .scard.pakan     { background:#eff6ff; border-color:#bfdbfe; }
        .scard.kesehatan { background:#fff1f2; border-color:#fecdd3; }
        .scard.net       { background:#fffbeb; border-color:#fde68a; }
        .scard .cl { font-size:9px; font-weight:700; text-transform:uppercase; letter-spacing:0.7px; margin-bottom:6px; display:flex; align-items:center; gap:5px; }
        .scard.income .cl    { color:#15803d; }
        .scard.pakan .cl     { color:#1d4ed8; }
        .scard.kesehatan .cl { color:#be123c; }
        .scard.net .cl       { color:#92400e; }
        .scard .cv { font-size:16px; font-weight:900; line-height:1.2; }
        .scard.income .cv    { color:#15803d; }
        .scard.pakan .cv     { color:#1d4ed8; }
        .scard.kesehatan .cv { color:#be123c; }
        .scard.net .cv       { color:#92400e; }
        .scard .cs { font-size:9px; margin-top:3px; opacity:0.55; }

        /* ===== SECTION TITLES ===== */
        .sec-title { display:flex; align-items:center; gap:8px; font-size:12px; font-weight:800; color:#111827; padding: 16px 32px 10px; border-top:1px solid #f3f4f6; }
        .sec-title .badge { font-size:9px; padding:2px 8px; border-radius:20px; font-weight:700; }
        .badge-green  { background:#dcfce7; color:#15803d; }
        .badge-blue   { background:#dbeafe; color:#1d4ed8; }
        .badge-red    { background:#fee2e2; color:#be123c; }
        .sec-stripe   { width:4px; height:16px; border-radius:2px; }
        .stripe-green  { background:linear-gradient(180deg,#22c55e,#15803d); }
        .stripe-blue   { background:linear-gradient(180deg,#3b82f6,#1d4ed8); }
        .stripe-red    { background:linear-gradient(180deg,#ef4444,#be123c); }

        /* ===== TABLES ===== */
        .tbl-wrap { padding: 0 32px 6px; }
        .rtbl { width:100%; border-collapse:collapse; font-size:10.5px; }
        .rtbl thead tr { background:linear-gradient(135deg,#1a1a2e,#16213e); }
        .rtbl thead th { padding:9px 10px; color:#FFD700; font-weight:700; font-size:9px; text-transform:uppercase; letter-spacing:0.6px; border:1px solid #2d3748; }
        .rtbl thead th.left { text-align:left; }
        .rtbl thead th.right { text-align:right; }
        .rtbl tbody tr:nth-child(even) { background:#fafafa; }
        .rtbl tbody tr:hover { background:#fffbeb; }
        .rtbl tbody td { padding:7.5px 10px; border:1px solid #e5e7eb; vertical-align:middle; }
        .td-no   { text-align:center; color:#9ca3af; font-size:9.5px; width:28px; }
        .td-date { color:#6b7280; font-size:10px; white-space:nowrap; }
        .td-name { font-weight:600; color:#111827; }
        .td-sub  { font-size:9px; color:#9ca3af; margin-top:1px; }
        .td-right { text-align:right; font-variant-numeric:tabular-nums; white-space:nowrap; }
        .td-center { text-align:center; }
        .money-green { color:#15803d; font-weight:700; }
        .money-blue  { color:#1d4ed8; font-weight:700; }
        .money-red   { color:#be123c; font-weight:700; }
        .chip { display:inline-block; padding:2px 8px; border-radius:20px; font-size:9px; font-weight:700; }
        .chip-qris     { background:#fef9c3; color:#713f12; }
        .chip-transfer { background:#dbeafe; color:#1e40af; }
        .chip-ewallet  { background:#f3e8ff; color:#6b21a8; }

        /* ===== TOTAL ROW ===== */
        .row-total td { background:linear-gradient(135deg,#fffbeb,#fef3c7)!important; border-top:2px solid #FFD700!important; border-bottom:2px solid #FFD700!important; font-weight:800!important; color:#78350f!important; }
        .row-total .money-green { color:#065f46!important; }
        .row-total .money-blue  { color:#1e3a8a!important; }
        .row-total .money-red   { color:#7f1d1d!important; }

        /* ===== REKAP SECTION ===== */
        .rekap-section { padding: 0 32px 20px; }
        .rekap-title { font-size:12px; font-weight:800; color:#111827; display:flex; align-items:center; gap:8px; padding-bottom:10px; }
        .rekap-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; }
        .rk-box { border-radius:10px; padding:14px; border:1px solid; text-align:center; }
        .rk-box.income   { background:#f0fdf4; border-color:#86efac; }
        .rk-box.expense  { background:#fff1f2; border-color:#fca5a5; }
        .rk-box.net-pos  { background:#fffbeb; border-color:#fde68a; }
        .rk-box.net-neg  { background:#fff0f3; border-color:#fda4af; }
        .rk-box .rk-label { font-size:9px; font-weight:700; text-transform:uppercase; letter-spacing:0.7px; margin-bottom:6px; }
        .rk-box.income .rk-label  { color:#15803d; }
        .rk-box.expense .rk-label { color:#be123c; }
        .rk-box.net-pos .rk-label,
        .rk-box.net-neg .rk-label { color:#92400e; }
        .rk-box .rk-val { font-size:17px; font-weight:900; line-height:1; }
        .rk-box.income .rk-val  { color:#15803d; }
        .rk-box.expense .rk-val { color:#be123c; }
        .rk-box.net-pos .rk-val { color:#065f46; }
        .rk-box.net-neg .rk-val { color:#be123c; }
        .rk-box .rk-sub { font-size:9px; margin-top:4px; opacity:0.55; }

        /* ===== SIGNATURES ===== */
        .sign-section { padding: 0 32px 28px; display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
        .sign-box { border:1px solid #e5e7eb; border-radius:8px; padding:14px 16px; background:#fafafa; text-align:center; }
        .sign-box .st { font-size:10px; font-weight:600; color:#374151; margin-bottom:52px; }
        .sign-box .sn { border-top:1px solid #9ca3af; font-size:10.5px; font-weight:700; color:#111827; padding-top:6px; }
        .sign-box .sr { font-size:9px; color:#6b7280; margin-top:2px; }

        /* ===== PAGE FOOTER ===== */
        .page-footer { background:#f8fafc; border-top:1px solid #e5e7eb; padding:10px 32px; display:flex; align-items:center; justify-content:space-between; font-size:9px; color:#9ca3af; }

        /* ===== EMPTY STATE ===== */
        .empty-td { text-align:center; padding:24px; color:#9ca3af; font-style:italic; }

        /* ===== PRINT ===== */
        @media print {
            body { background:#fff; font-size:9.5px; }
            .page-wrapper { max-width:100%; margin:0; box-shadow:none; border-radius:0; }
            .filter-bar, .btn-print, .btn-back { display:none!important; }
            .report-header, .rtbl thead tr, .scard, .row-total td, .rk-box {
                -webkit-print-color-adjust:exact; print-color-adjust:exact; color-adjust:exact;
            }
            @page { margin:8mm 12mm; size:A4 landscape; }
        }
    </style>
</head>
<body>
<div class="page-wrapper">

    {{-- ===== HEADER ===== --}}
    <div class="report-header">
        <div class="header-top">
            <div class="header-logo">
                <div class="logo-icon">🦤</div>
                <div class="logo-text">
                    <h1>Ostrich Mini Zoo</h1>
                    <p>Laporan Keuangan Operasional Sistem</p>
                </div>
            </div>
            <div class="header-meta">
                <div class="doc-title">LAPORAN KEUANGAN</div>
                <div class="doc-info">
                    Periode: <strong style="color:#fff">{{ $periodeLabel }}</strong><br>
                    Dicetak: {{ now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}<br>
                    Oleh: Manager &nbsp;|&nbsp; Sistem: Ostrich Smart Hub
                </div>
            </div>
        </div>
        <div class="header-stats">
            <div class="hstat">
                <span class="hl">Pemasukan Tiket</span>
                <span class="hv green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
            </div>
            <div class="hstat">
                <span class="hl">Pengeluaran Pakan</span>
                <span class="hv red">Rp {{ number_format($totalPakan, 0, ',', '.') }}</span>
            </div>
            <div class="hstat">
                <span class="hl">Pengeluaran Kesehatan</span>
                <span class="hv red">Rp {{ number_format($totalKesehatan, 0, ',', '.') }}</span>
            </div>
            <div class="hstat">
                <span class="hl">Total Pengeluaran</span>
                <span class="hv red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
            </div>
            <div class="hstat">
                <span class="hl">Saldo Bersih</span>
                <span class="hv {{ $saldoBersih >= 0 ? 'gold' : 'red' }}">Rp {{ number_format(abs($saldoBersih), 0, ',', '.') }}{{ $saldoBersih < 0 ? ' (Defisit)' : '' }}</span>
            </div>
            <div class="hstat">
                <span class="hl">Tiket Terjual</span>
                <span class="hv gold">{{ $orders->sum('jumlah_tiket') }} Tiket</span>
            </div>
        </div>
    </div>

    {{-- ===== FILTER BAR ===== --}}
    <div class="filter-bar">
        <form method="GET" action="{{ route('manager.laporan') }}" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <label>Tahun:</label>
            <select name="tahun" onchange="this.form.submit()">
                @foreach($tahunList as $thn)
                    <option value="{{ $thn }}" {{ $tahunFilter == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                @endforeach
            </select>
            <label>Bulan:</label>
            <select name="bulan" onchange="this.form.submit()">
                @foreach($bulanList as $key => $label)
                    <option value="{{ $key }}" {{ $bulanFilter == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-f btn-apply">Tampilkan</button>
        </form>
        <div class="spacer"></div>
        <a href="{{ route('manager.dashboard') }}" class="btn-f btn-back">← Dashboard</a>
        <button class="btn-f btn-print" onclick="window.print()">🖨️ Print / PDF</button>
    </div>

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="summary-section">
        <div class="scard income">
            <div class="cl">📥 Pemasukan Tiket</div>
            <div class="cv">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            <div class="cs">{{ $orders->count() }} transaksi · {{ $orders->sum('jumlah_tiket') }} tiket terjual</div>
        </div>
        <div class="scard pakan">
            <div class="cl">🌾 Pengeluaran Pakan</div>
            <div class="cv">Rp {{ number_format($totalPakan, 0, ',', '.') }}</div>
            <div class="cs">{{ $pakans->count() }} pembelian pakan</div>
        </div>
        <div class="scard kesehatan">
            <div class="cl">💊 Pengeluaran Kesehatan</div>
            <div class="cv">Rp {{ number_format($totalKesehatan, 0, ',', '.') }}</div>
            <div class="cs">{{ $kesehatans->count() }} penanganan hewan</div>
        </div>
        <div class="scard net">
            <div class="cl">⚖️ Saldo Bersih</div>
            <div class="cv" style="{{ $saldoBersih < 0 ? 'color:#be123c' : '' }}">
                @if($saldoBersih < 0)— @endif Rp {{ number_format(abs($saldoBersih), 0, ',', '.') }}
            </div>
            <div class="cs">Pemasukan – Total Pengeluaran</div>
        </div>
    </div>

    {{-- ====================================================== --}}
    {{-- TABEL 1: PEMASUKAN — PENJUALAN TIKET                   --}}
    {{-- ====================================================== --}}
    <div class="sec-title">
        <div class="sec-stripe stripe-green"></div>
        Pemasukan — Penjualan Tiket Masuk
        <span class="badge badge-green">{{ $orders->count() }} transaksi</span>
        <span class="badge badge-green">Total: Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
    </div>
    <div class="tbl-wrap">
        <table class="rtbl">
            <thead>
                <tr>
                    <th class="left" style="width:22px">No</th>
                    <th class="left">Tgl Order</th>
                    <th>Jml Tiket</th>
                    <th class="right">Harga/Tiket</th>
                    <th class="right">Total (Rp)</th>
                    <th class="left">Metode</th>
                    <th>Tgl Kunjungan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $i => $o)
                <tr>
                    <td class="td-no">{{ $i + 1 }}</td>
                    <td class="td-date">{{ $o->tanggal_order->locale('id')->isoFormat('D MMM YY') }}</td>
                    <td class="td-center" style="font-weight:700">{{ $o->jumlah_tiket }}</td>
                    <td class="td-right" style="color:#6b7280">{{ number_format($o->harga_satuan, 0, ',', '.') }}</td>
                    <td class="td-right money-green">{{ number_format($o->total_harga, 0, ',', '.') }}</td>
                    <td class="td-center">
                        <span class="chip chip-{{ $o->metode_bayar }}">{{ strtoupper($o->metode_bayar) }}</span>
                    </td>
                    <td class="td-date td-center">{{ $o->tanggal_kunjungan->locale('id')->isoFormat('D MMM YY') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-td">Belum ada transaksi tiket pada periode ini.</td></tr>
                @endforelse
                @if($orders->count() > 0)
                <tr class="row-total">
                    <td colspan="2" style="text-align:right;font-size:11px"><strong>TOTAL</strong></td>
                    <td class="td-center" style="font-weight:800">{{ $orders->sum('jumlah_tiket') }}</td>
                    <td></td>
                    <td class="td-right money-green">{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- ====================================================== --}}
    {{-- TABEL 2: PENGELUARAN — PEMBELIAN PAKAN                 --}}
    {{-- ====================================================== --}}
    <div class="sec-title">
        <div class="sec-stripe stripe-blue"></div>
        Pengeluaran — Pembelian Pakan Hewan
        <span class="badge badge-blue">{{ $pakans->count() }} pembelian</span>
        <span class="badge badge-blue">Total: Rp {{ number_format($totalPakan, 0, ',', '.') }}</span>
    </div>
    <div class="tbl-wrap">
        <table class="rtbl">
            <thead>
                <tr>
                    <th class="left" style="width:22px">No</th>
                    <th class="left">Tanggal</th>
                    <th class="left">Nama Pakan / Bahan</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th class="right">Harga/Satuan</th>
                    <th class="right">Total (Rp)</th>
                    <th class="left">Dilaporkan Oleh</th>
                    <th class="left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pakans as $i => $p)
                <tr>
                    <td class="td-no">{{ $i + 1 }}</td>
                    <td class="td-date">{{ $p->tanggal->locale('id')->isoFormat('D MMM YY') }}</td>
                    <td class="td-name">{{ $p->nama_pakan }}</td>
                    <td class="td-center" style="font-weight:600">{{ $p->jumlah }}</td>
                    <td class="td-center" style="color:#6b7280">{{ $p->satuan }}</td>
                    <td class="td-right" style="color:#6b7280">{{ number_format($p->harga_satuan, 0, ',', '.') }}</td>
                    <td class="td-right money-blue">{{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td style="color:#6b7280; font-size:10px">{{ $p->pelapor ?? '—' }}</td>
                    <td style="color:#9ca3af; font-size:10px; max-width:140px">{{ Str::limit($p->keterangan, 45) ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="9" class="empty-td">Belum ada pembelian pakan pada periode ini.</td></tr>
                @endforelse
                @if($pakans->count() > 0)
                <tr class="row-total">
                    <td colspan="6" style="text-align:right;font-size:11px"><strong>TOTAL PAKAN</strong></td>
                    <td class="td-right money-blue">{{ number_format($totalPakan, 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- ====================================================== --}}
    {{-- TABEL 3: PENGELUARAN — BIAYA KESEHATAN HEWAN           --}}
    {{-- ====================================================== --}}
    <div class="sec-title">
        <div class="sec-stripe stripe-red"></div>
        Pengeluaran — Biaya Kesehatan & Penanganan Hewan
        <span class="badge badge-red">{{ $kesehatans->count() }} penanganan</span>
        <span class="badge badge-red">Total: Rp {{ number_format($totalKesehatan, 0, ',', '.') }}</span>
    </div>
    <div class="tbl-wrap" style="margin-bottom:20px">
        <table class="rtbl">
            <thead>
                <tr>
                    <th class="left" style="width:22px">No</th>
                    <th class="left">Tanggal</th>
                    <th class="left">Nama Hewan</th>
                    <th class="left">Jenis Penanganan</th>
                    <th class="right">Biaya (Rp)</th>
                    <th class="left">Nama Dokter/drh</th>
                    <th class="left">Keterangan / Kondisi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kesehatans as $i => $k)
                <tr>
                    <td class="td-no">{{ $i + 1 }}</td>
                    <td class="td-date">{{ $k->tanggal->locale('id')->isoFormat('D MMM YY') }}</td>
                    <td>
                        <span class="td-name">🐾 {{ $k->nama_hewan }}</span>
                    </td>
                    <td>
                        <span class="chip" style="background:#fee2e2; color:#991b1b">{{ $k->jenis_penanganan }}</span>
                    </td>
                    <td class="td-right money-red">{{ number_format($k->biaya, 0, ',', '.') }}</td>
                    <td style="color:#6b7280; font-size:10px">{{ $k->nama_dokter ?? '—' }}</td>
                    <td style="color:#9ca3af; font-size:10px; max-width:160px">{{ Str::limit($k->keterangan, 55) ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-td">Belum ada penanganan kesehatan pada periode ini.</td></tr>
                @endforelse
                @if($kesehatans->count() > 0)
                <tr class="row-total">
                    <td colspan="4" style="text-align:right;font-size:11px"><strong>TOTAL KESEHATAN</strong></td>
                    <td class="td-right money-red">{{ number_format($totalKesehatan, 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- ===== REKAPITULASI AKHIR ===== --}}
    <div class="rekap-section">
        <div class="rekap-title">
            <span style="font-size:14px">📊</span>
            Rekapitulasi Keuangan — {{ $periodeLabel }}
        </div>
        <div class="rekap-grid">
            <div class="rk-box income">
                <div class="rk-label">📥 Total Pemasukan</div>
                <div class="rk-val">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                <div class="rk-sub">{{ $orders->sum('jumlah_tiket') }} tiket dari {{ $orders->count() }} transaksi</div>
            </div>
            <div class="rk-box expense">
                <div class="rk-label">📤 Total Pengeluaran</div>
                <div class="rk-val">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div class="rk-sub">Pakan Rp {{ number_format($totalPakan, 0, ',', '.') }} + Kesehatan Rp {{ number_format($totalKesehatan, 0, ',', '.') }}</div>
            </div>
            <div class="rk-box {{ $saldoBersih >= 0 ? 'net-pos' : 'net-neg' }}">
                <div class="rk-label">⚖️ Saldo Bersih</div>
                <div class="rk-val">@if($saldoBersih < 0)— @endif Rp {{ number_format(abs($saldoBersih), 0, ',', '.') }}</div>
                <div class="rk-sub">{{ $saldoBersih >= 0 ? '✅ Surplus' : '⚠️ Defisit' }}</div>
            </div>
        </div>
    </div>

    {{-- ===== TANDA TANGAN ===== --}}
    <div class="sign-section">
        <div class="sign-box">
            <div class="st">Dibuat Oleh</div>
            <div class="sn">( _________________ )</div>
            <div class="sr">Admin / Staff Sistem</div>
        </div>
        <div class="sign-box">
            <div class="st">Diperiksa Oleh</div>
            <div class="sn">( _________________ )</div>
            <div class="sr">Supervisor / Wakil Manager</div>
        </div>
        <div class="sign-box">
            <div class="st">Disetujui Oleh</div>
            <div class="sn">( _________________ )</div>
            <div class="sr">Manager Ostrich Mini Zoo</div>
        </div>
    </div>

    {{-- ===== PAGE FOOTER ===== --}}
    <div class="page-footer">
        <span>📄 Laporan Keuangan · Ostrich Mini Zoo · {{ $periodeLabel }}</span>
        <span>Otomatis dari Ostrich Smart Hub · Dicetak {{ now()->format('d/m/Y H:i') }}</span>
    </div>

</div>

<script>
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') window.print();
});
</script>
</body>
</html>
