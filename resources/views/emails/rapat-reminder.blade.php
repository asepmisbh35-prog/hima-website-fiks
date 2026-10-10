<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/himadikti.png') }}">
    <title>Reminder Rapat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 40px 32px;
            text-align: center;
        }

        .header .bell {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
        }

        .header h1 {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.3;
        }

        .header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            margin-top: 8px;
        }

        .badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            margin-top: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .content {
            padding: 32px;
        }

        .greeting {
            font-size: 16px;
            color: #374151;
            margin-bottom: 16px;
        }

        .greeting strong {
            color: #1e40af;
        }

        .intro {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .card {
            background: #f8faff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .detail-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-icon {
            font-size: 18px;
            margin-right: 12px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .detail-label {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 14px;
            color: #1f2937;
            font-weight: 500;
            margin-top: 2px;
        }

        .agenda-box {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 16px;
        }

        .agenda-label {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .agenda-text {
            font-size: 13px;
            color: #374151;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .cta-section {
            text-align: center;
            margin: 24px 0;
        }

        .cta-text {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .footer {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 24px 32px;
            text-align: center;
        }

        .footer p {
            font-size: 12px;
            color: #9ca3af;
            line-height: 1.6;
        }

        .footer strong {
            color: #374151;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 20px 0;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            @if ($logoBase64)
                <img src="{{ $logoBase64 }}" alt="HIMADIKTI"
                    style="height: 60px; width: auto; margin-bottom: 16px; display: block; margin-left: auto; margin-right: auto;">
            @endif
            <span class="bell">🔔</span>
            <h1>Pengingat Rapat Besok</h1>
            <p>Jangan sampai terlewat!</p>
            <span class="badge">H-1 Reminder</span>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Halo, <strong>{{ $peserta->name }}</strong>!</p>
            <p class="intro">
                Kami mengingatkan bahwa Anda dijadwalkan untuk hadir dalam rapat berikut yang akan berlangsung
                <strong>besok</strong>. Harap mempersiapkan diri sebaik mungkin.
            </p>

            <!-- Rapat Card -->
            <div class="card">
                <div class="card-title">{{ $rapat->judul_rapat }}</div>

                <div class="detail-row">
                    <span class="detail-icon">📅</span>
                    <div>
                        <div class="detail-label">Tanggal & Waktu</div>
                        <div class="detail-value">
                            {{ $rapat->tanggal_waktu->translatedFormat('l, d F Y') }} — Pukul
                            {{ $rapat->tanggal_waktu->format('H:i') }} WIB
                        </div>
                    </div>
                </div>

                <div class="detail-row">
                    <span class="detail-icon">📍</span>
                    <div>
                        <div class="detail-label">Lokasi</div>
                        <div class="detail-value">{{ $rapat->lokasi }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <span class="detail-icon">👤</span>
                    <div>
                        <div class="detail-label">Dijadwalkan Oleh</div>
                        <div class="detail-value">{{ $rapat->pembuat->name }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <span class="detail-icon">👥</span>
                    <div>
                        <div class="detail-label">Jumlah Peserta</div>
                        <div class="detail-value">{{ $rapat->getPesertaCount() }} orang</div>
                    </div>
                </div>

                <div class="agenda-box">
                    <div class="agenda-label">📋 Agenda Rapat</div>
                    <div class="agenda-text">{{ $rapat->agenda }}</div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="cta-section">
                <p class="cta-text">💡 <strong>Tips:</strong> Hadir tepat waktu dan siapkan kontribusi Anda untuk agenda
                    di atas.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem <strong>HIMA</strong>.</p>
            <p>Jika ada pertanyaan, hubungi <strong>{{ $rapat->pembuat->email }}</strong>
                ({{ $rapat->pembuat->name }}).</p>
        </div>
    </div>
</body>

</html>
