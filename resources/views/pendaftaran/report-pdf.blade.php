<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendaftaran - {{ $periode->nama_periode }}</title>
    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #1e293b;
            background: #fff;
            line-height: 1.5;
        }

        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #fff;
            padding: 24px 30px;
            margin-bottom: 0;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .org-name {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.9;
        }

        .doc-type {
            font-size: 9px;
            background: rgba(255,255,255,0.2);
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .report-subtitle {
            font-size: 11px;
            opacity: 0.85;
        }

        .header-meta {
            margin-top: 12px;
            display: flex;
            gap: 24px;
        }

        .meta-item {
            font-size: 9px;
            opacity: 0.8;
        }

        .meta-item strong {
            display: block;
            font-size: 10px;
            opacity: 1;
            margin-bottom: 1px;
        }

        /* ===== STATS BAR ===== */
        .stats-bar {
            display: flex;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }

        .stat-box {
            flex: 1;
            text-align: center;
            padding: 14px 10px;
            border-right: 1px solid #e2e8f0;
        }

        .stat-box:last-child {
            border-right: none;
        }

        .stat-number {
            font-size: 22px;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-total    .stat-number { color: #4f46e5; }
        .stat-menunggu .stat-number { color: #d97706; }
        .stat-diterima .stat-number { color: #16a34a; }
        .stat-ditolak  .stat-number { color: #dc2626; }

        /* ===== CONTENT ===== */
        .content {
            padding: 20px 24px;
        }

        /* ===== TABLE ===== */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #4f46e5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 2px solid #4f46e5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 9px;
        }

        thead tr {
            background: #4f46e5;
            color: #fff;
        }

        thead th {
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        tbody tr:hover {
            background: #f1f5f9;
        }

        tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        /* ===== STATUS BADGES ===== */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .badge-menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-diterima {
            background: #dcfce7;
            color: #14532d;
        }

        .badge-ditolak {
            background: #fee2e2;
            color: #7f1d1d;
        }

        /* ===== NO DATA ===== */
        .no-data {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-style: italic;
        }

        /* ===== PERIODE INFO CARD ===== */
        .periode-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #4f46e5;
            border-radius: 4px;
            padding: 12px 16px;
            margin-bottom: 18px;
            display: flex;
            gap: 40px;
        }

        .periode-field label {
            display: block;
            font-size: 8px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .periode-field span {
            font-size: 10px;
            font-weight: bold;
            color: #1e293b;
        }

        .status-aktif {
            color: #16a34a !important;
        }

        .status-nonaktif {
            color: #dc2626 !important;
        }

        /* ===== PER STATUS SECTION ===== */
        .status-section {
            margin-bottom: 24px;
            page-break-inside: avoid;
        }

        .status-header {
            display: flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 4px;
            margin-bottom: 8px;
            font-size: 10px;
            font-weight: bold;
        }

        .status-header.menunggu {
            background: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        .status-header.diterima {
            background: #dcfce7;
            color: #14532d;
            border-left: 4px solid #22c55e;
        }

        .status-header.ditolak {
            background: #fee2e2;
            color: #7f1d1d;
            border-left: 4px solid #ef4444;
        }

        .status-count {
            margin-left: 8px;
            font-size: 9px;
            opacity: 0.8;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 30px;
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 2px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 8px;
            color: #64748b;
        }

        .signature-box {
            text-align: center;
        }

        .signature-line {
            width: 150px;
            border-top: 1px solid #94a3b8;
            margin: 40px auto 4px;
        }

        .signature-name {
            font-size: 9px;
            font-weight: bold;
            color: #1e293b;
        }

        .footer-info {
            font-size: 8px;
            color: #94a3b8;
        }

        /* ===== NO WRAP ===== */
        .nowrap {
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }

        .motivasi-cell {
            max-width: 160px;
            overflow: hidden;
        }

        /* ===== PAGE BREAK ===== */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <!-- ===== HEADER ===== -->
    <div class="header">
        <div class="header-top">
            <div class="org-name">Sistem Pendaftaran Pengurus Muda</div>
            <div class="doc-type">LAPORAN RESMI</div>
        </div>
        <div class="report-title">Laporan Pendaftaran Pengurus</div>
        <div class="report-subtitle">{{ $periode->nama_periode }}</div>
        <div class="header-meta">
            <div class="meta-item">
                <strong>Tanggal Cetak</strong>
                {{ $generated_at }}
            </div>
            <div class="meta-item">
                <strong>Dicetak Oleh</strong>
                {{ $generated_by }}
            </div>
            <div class="meta-item">
                <strong>Periode Pendaftaran</strong>
                {{ \Carbon\Carbon::parse($periode->tanggal_buka)->format('d M Y') }} –
                {{ \Carbon\Carbon::parse($periode->tanggal_tutup)->format('d M Y') }}
            </div>
        </div>
    </div>

    <!-- ===== STATS BAR ===== -->
    <div class="stats-bar">
        <div class="stat-box stat-total">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Pendaftar</div>
        </div>
        <div class="stat-box stat-menunggu">
            <div class="stat-number">{{ $stats['menunggu'] }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat-box stat-diterima">
            <div class="stat-number">{{ $stats['diterima'] }}</div>
            <div class="stat-label">Diterima</div>
        </div>
        <div class="stat-box stat-ditolak">
            <div class="stat-number">{{ $stats['ditolak'] }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    <!-- ===== CONTENT ===== -->
    <div class="content">

        <!-- Info Periode -->
        <div class="periode-card">
            <div class="periode-field">
                <label>Nama Periode</label>
                <span>{{ $periode->nama_periode }}</span>
            </div>
            <div class="periode-field">
                <label>Tanggal Buka</label>
                <span>{{ \Carbon\Carbon::parse($periode->tanggal_buka)->format('d M Y') }}</span>
            </div>
            <div class="periode-field">
                <label>Tanggal Tutup</label>
                <span>{{ \Carbon\Carbon::parse($periode->tanggal_tutup)->format('d M Y') }}</span>
            </div>
            <div class="periode-field">
                <label>Status Periode</label>
                <span class="{{ $periode->is_active ? 'status-aktif' : 'status-nonaktif' }}">
                    {{ $periode->is_active ? '● Aktif' : '○ Nonaktif' }}
                </span>
            </div>
            @if($periode->deskripsi)
            <div class="periode-field">
                <label>Deskripsi</label>
                <span>{{ Str::limit($periode->deskripsi, 80) }}</span>
            </div>
            @endif
        </div>

        @if($pendaftaran->isEmpty())
            <div class="no-data">
                <p>Belum ada data pendaftar pada periode ini.</p>
            </div>
        @else

            {{-- ===== SECTION: DITERIMA ===== --}}
            @php $diterima = $pendaftaran->where('status', 'diterima'); @endphp
            @if($diterima->count() > 0)
            <div class="status-section">
                <div class="status-header diterima">
                    ✓ Pendaftar Diterima
                    <span class="status-count">({{ $diterima->count() }} orang)</span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:25px">#</th>
                            <th style="width:60px">Kode</th>
                            <th style="width:130px">Nama Lengkap</th>
                            <th style="width:65px">NIM</th>
                            <th style="width:100px">Jurusan</th>
                            <th style="width:110px">Email</th>
                            <th style="width:70px">Tgl Daftar</th>
                            <th style="width:70px">Diverifikasi</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diterima as $i => $item)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="nowrap" style="font-family: monospace; font-size: 8px;">{{ $item->kode_pendaftaran }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td style="font-size: 8px;">{{ $item->user->email ?? '-' }}</td>
                            <td class="nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="nowrap">
                                {{ $item->tanggal_verifikasi ? \Carbon\Carbon::parse($item->tanggal_verifikasi)->format('d/m/Y') : '-' }}
                            </td>
                            <td style="font-size: 8px; color: #64748b;">{{ $item->catatan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            {{-- ===== SECTION: MENUNGGU ===== --}}
            @php $menunggu = $pendaftaran->where('status', 'menunggu'); @endphp
            @if($menunggu->count() > 0)
            <div class="status-section">
                <div class="status-header menunggu">
                    ⏳ Pendaftar Menunggu Review
                    <span class="status-count">({{ $menunggu->count() }} orang)</span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:25px">#</th>
                            <th style="width:60px">Kode</th>
                            <th style="width:130px">Nama Lengkap</th>
                            <th style="width:65px">NIM</th>
                            <th style="width:100px">Jurusan</th>
                            <th style="width:110px">Email</th>
                            <th style="width:70px">Tgl Daftar</th>
                            <th>Motivasi (Ringkasan)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menunggu as $i => $item)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="nowrap" style="font-family: monospace; font-size: 8px;">{{ $item->kode_pendaftaran }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td style="font-size: 8px;">{{ $item->user->email ?? '-' }}</td>
                            <td class="nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="motivasi-cell" style="font-size: 8px; color: #475569;">
                                {{ \Illuminate\Support\Str::limit($item->motivasi, 80) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            {{-- ===== SECTION: DITOLAK ===== --}}
            @php $ditolak = $pendaftaran->where('status', 'ditolak'); @endphp
            @if($ditolak->count() > 0)
            <div class="status-section">
                <div class="status-header ditolak">
                    ✗ Pendaftar Ditolak
                    <span class="status-count">({{ $ditolak->count() }} orang)</span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:25px">#</th>
                            <th style="width:60px">Kode</th>
                            <th style="width:130px">Nama Lengkap</th>
                            <th style="width:65px">NIM</th>
                            <th style="width:100px">Jurusan</th>
                            <th style="width:110px">Email</th>
                            <th style="width:70px">Tgl Daftar</th>
                            <th style="width:70px">Diverifikasi</th>
                            <th>Catatan Penolakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ditolak as $i => $item)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="nowrap" style="font-family: monospace; font-size: 8px;">{{ $item->kode_pendaftaran }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td style="font-size: 8px;">{{ $item->user->email ?? '-' }}</td>
                            <td class="nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="nowrap">
                                {{ $item->tanggal_verifikasi ? \Carbon\Carbon::parse($item->tanggal_verifikasi)->format('d/m/Y') : '-' }}
                            </td>
                            <td style="font-size: 8px; color: #64748b;">{{ $item->catatan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        @endif
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="footer">
        <div>
            <div style="margin-bottom: 4px;">Dokumen ini digenerate secara otomatis oleh Sistem Pendaftaran Pengurus</div>
            <div class="footer-info">Dicetak pada: {{ $generated_at }} | Oleh: {{ $generated_by }}</div>
        </div>
        <div class="signature-box">
            <div style="font-size: 9px; color: #475569; margin-bottom: 2px;">Mengetahui,</div>
            <div class="signature-line"></div>
            <div class="signature-name">Pengurus Inti</div>
            <div style="font-size: 8px; color: #64748b;">Jabatan</div>
        </div>
    </div>

</body>
</html>