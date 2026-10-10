<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Arsip Surat</title>
    <style>
        /* ── Reset & Base ───────────────────────────────────────────── */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt;
            color: #1a1a2e;
            background: #ffffff;
        }

        /* ── Header / Kop Laporan ───────────────────────────────────── */
        .header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);
            color: #ffffff;
            padding: 20px 24px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .header-top {
            display: flex;           /* DomPDF tidak support flexbox sepenuhnya, */
            /* pakai tabel agar lebih aman di DomPDF     */
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            padding: 0;
            vertical-align: middle;
        }

        .header-logo-cell {
            width: 60px;
        }

        .logo-circle {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            text-align: center;
            line-height: 52px;
            font-size: 22pt;
            font-weight: 900;
            color: #ffffff;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .header-title-cell {
            padding-left: 14px;
        }

        .org-name {
            font-size: 8pt;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.80);
            margin-bottom: 4px;
        }

        .report-title {
            font-size: 18pt;
            font-weight: 900;
            letter-spacing: 0.5px;
            color: #ffffff;
            margin-bottom: 2px;
        }

        .report-subtitle {
            font-size: 8pt;
            color: rgba(255, 255, 255, 0.75);
        }

        .header-meta-cell {
            text-align: right;
            vertical-align: top;
            padding-top: 4px;
        }

        .meta-badge {
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 4px;
            padding: 5px 10px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .meta-badge p {
            font-size: 7.5pt;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 1px;
        }

        .meta-badge span {
            font-size: 8.5pt;
            font-weight: 700;
            color: #ffffff;
        }

        /* ── Info Bar ───────────────────────────────────────────────── */
        .info-bar {
            background: #f0f4f8;
            border-left: 4px solid #2d6a9f;
            border-radius: 0 4px 4px 0;
            padding: 8px 14px;
            margin-bottom: 16px;
            font-size: 8pt;
            color: #374151;
        }

        .info-bar span {
            font-weight: 700;
            color: #1e3a5f;
        }

        /* ── Tabel ──────────────────────────────────────────────────── */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }

        table.data-table thead tr {
            background: #1e3a5f;
            color: #ffffff;
        }

        table.data-table thead th {
            padding: 8px 7px;
            text-align: left;
            font-weight: 700;
            font-size: 7.5pt;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            border: 1px solid #16304f;
            white-space: nowrap;
        }

        table.data-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        table.data-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        table.data-table tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        table.data-table tbody td {
            padding: 7px 7px;
            vertical-align: top;
            border: 1px solid #e5e7eb;
            color: #374151;
            line-height: 1.4;
        }

        /* Kolom no urut */
        td.col-no, th.col-no {
            width: 22px;
            text-align: center;
        }

        /* Kolom nomor surat */
        td.col-nomor {
            width: 110px;
            font-family: 'Courier New', monospace;
            font-size: 7.5pt;
            font-weight: 600;
            color: #1e3a5f;
            word-break: break-all;
        }

        /* Kolom jenis */
        td.col-jenis {
            width: 55px;
            text-align: center;
        }

        /* Badge jenis surat */
        .badge {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 20px;
            font-size: 7pt;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-masuk    { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .badge-keluar   { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .badge-resmi    { background: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe; }
        .badge-notulensi{ background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .badge-lainnya  { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }

        /* Kolom perihal */
        td.col-perihal {
            /* flex / auto width */
            color: #111827;
            font-weight: 600;
        }

        /* Kolom tanggal */
        td.col-tanggal {
            width: 70px;
            white-space: nowrap;
        }

        /* Kolom pengirim/penerima */
        td.col-pihak {
            width: 90px;
            font-size: 7.5pt;
        }

        /* Kolom kategori */
        td.col-kategori {
            width: 70px;
            font-size: 7.5pt;
            color: #6b7280;
            font-style: italic;
        }

        /* Empty state */
        .empty-row td {
            text-align: center;
            padding: 30px;
            color: #9ca3af;
            font-style: italic;
        }

        /* ── Footer ─────────────────────────────────────────────────── */
        .footer {
            margin-top: 18px;
            border-top: 2px solid #e5e7eb;
            padding-top: 10px;
            text-align: center;
            font-size: 7pt;
            color: #9ca3af;
        }

        .footer strong {
            color: #6b7280;
        }

        /* ── Page break ─────────────────────────────────────────────── */
        @page {
            margin: 15mm 12mm 15mm 12mm;
        }
    </style>
</head>
<body>

    {{-- ═══════════════════════════════════════════════════════════════
         HEADER
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="header">
        <table class="header-table">
            <tr>
                {{-- Logo / inisial --}}
                <td class="header-logo-cell">
                    <div class="logo-circle">&#9993;</div>
                </td>

                {{-- Judul --}}
                <td class="header-title-cell">
                    <p class="org-name">Himpunan Mahasiswa &mdash; Arsip Digital</p>
                    <p class="report-title">Laporan Arsip Surat</p>
                    <p class="report-subtitle">Rekap seluruh surat masuk, keluar, dan internal</p>
                </td>

                {{-- Meta info kanan --}}
                <td class="header-meta-cell">
                    <div class="meta-badge">
                        <p>Tanggal Cetak</p>
                        <span>{{ now()->translatedFormat('d F Y') }}</span>
                    </div>
                    <br>
                    <div class="meta-badge">
                        <p>Total Surat</p>
                        <span>{{ $arsip->count() }} surat</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         INFO BAR
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="info-bar">
        Dokumen ini digenerate otomatis pada
        <span>{{ now()->translatedFormat('l, d F Y \p\u\k\u\l H:i') }} WIB</span>
        &nbsp;|&nbsp; Dicetak oleh: <span>{{ auth()->user()->name ?? 'Sistem' }}</span>
        &nbsp;|&nbsp; Status: <span>Rahasia / Internal</span>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         TABEL DATA
    ═══════════════════════════════════════════════════════════════ --}}
    <table class="data-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-nomor">Nomor Surat</th>
                <th class="col-jenis">Jenis</th>
                <th class="col-perihal">Perihal</th>
                <th class="col-tanggal">Tgl. Surat</th>
                <th class="col-pihak">Pengirim</th>
                <th class="col-pihak">Penerima</th>
                <th class="col-kategori">Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsip as $index => $item)
                <tr>
                    {{-- No urut --}}
                    <td class="col-no" style="text-align:center; color:#9ca3af;">
                        {{ $index + 1 }}
                    </td>

                    {{-- Nomor Surat --}}
                    <td class="col-nomor">{{ $item->nomor_surat }}</td>

                    {{-- Jenis Surat (badge warna) --}}
                    <td class="col-jenis">
                        @php
                            $badgeClass = match($item->jenis_surat) {
                                'masuk'     => 'badge-masuk',
                                'keluar'    => 'badge-keluar',
                                'resmi'     => 'badge-resmi',
                                'notulensi' => 'badge-notulensi',
                                default     => 'badge-lainnya',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($item->jenis_surat) }}
                        </span>
                    </td>

                    {{-- Perihal --}}
                    <td class="col-perihal">{{ $item->perihal }}</td>

                    {{-- Tanggal Surat --}}
                    <td class="col-tanggal">
                        {{ $item->tanggal_surat->translatedFormat('d M Y') }}
                    </td>

                    {{-- Pengirim --}}
                    <td class="col-pihak">{{ $item->pengirim ?? '—' }}</td>

                    {{-- Penerima --}}
                    <td class="col-pihak">{{ $item->penerima ?? '—' }}</td>

                    {{-- Kategori --}}
                    <td class="col-kategori">{{ $item->kategori ?? '—' }}</td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="8">Belum ada data arsip surat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ═══════════════════════════════════════════════════════════════
         FOOTER
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="footer">
        <strong>DOKUMEN RAHASIA &mdash; HANYA UNTUK INTERNAL</strong><br>
        Laporan ini digenerate otomatis oleh Sistem Informasi Himpunan Mahasiswa.
        Dilarang menyebarluaskan tanpa izin pengurus inti.
    </div>

</body>
</html>