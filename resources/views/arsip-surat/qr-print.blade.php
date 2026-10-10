<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Upload Surat - HIMADIKTI</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* ── Tombol aksi (tidak ikut tercetak) ── */
        .action-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 28px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            padding: 11px 26px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-print {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            color: #fff;
        }

        .btn-back {
            background: #e5e7eb;
            color: #374151;
        }

        /* ── Kartu QR — yang dicetak ── */
        .card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            padding: 44px 52px;
            text-align: center;
            max-width: 440px;
            width: 100%;
        }

        /* Header kartu */
        .org-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 6px;
        }

        .title {
            font-size: 26px;
            font-weight: 900;
            color: #111827;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        /* Wrapper QR dengan border oranye */
        .qr-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            border: 3px solid #ea580c;
            border-radius: 20px;
            margin-bottom: 28px;
            background: #fff;
            position: relative;
        }

        /* Sudut dekoratif */
        .qr-wrapper::before,
        .qr-wrapper::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-color: #ea580c;
            border-style: solid;
        }

        .qr-wrapper::before {
            top: -3px;
            left: -3px;
            border-width: 3px 0 0 3px;
            border-radius: 4px 0 0 0;
        }

        .qr-wrapper::after {
            bottom: -3px;
            right: -3px;
            border-width: 0 3px 3px 0;
            border-radius: 0 0 4px 0;
        }

        #qrcode canvas,
        #qrcode img {
            display: block;
            border-radius: 4px;
        }

        /* Instruksi */
        .instruction {
            font-size: 13px;
            color: #374151;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .instruction .highlight {
            display: inline-block;
            background: #fff7ed;
            color: #ea580c;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            border: 1px solid #fed7aa;
        }

        .instruction .note {
            display: block;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 4px;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px dashed #e5e7eb;
            margin: 20px 0;
        }

        /* URL box */
        .url-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 10.5px;
            color: #6b7280;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            letter-spacing: 0.2px;
        }

        /* Badge login required */
        .login-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 12px;
            padding: 5px 12px;
            background: #fef3c7;
            border: 1px solid #fde68a;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: #92400e;
        }

        /* Footer kartu */
        .footer-note {
            font-size: 10px;
            color: #9ca3af;
            line-height: 1.6;
            margin-top: 20px;
        }

        .footer-note strong {
            color: #6b7280;
        }

        /* ══ PRINT STYLES ══ */
        @media print {
            body {
                background: #fff;
                padding: 10mm;
                justify-content: flex-start;
            }

            .action-bar {
                display: none !important;
            }

            .card {
                box-shadow: none;
                border: 1.5px solid #e5e7eb;
                border-radius: 12px;
                margin: 0 auto;
                padding: 32px 40px;
            }

            /* Pastikan QR tajam saat dicetak */
            #qrcode canvas {
                image-rendering: pixelated;
            }
        }
    </style>
</head>
<body>

    {{-- ── Tombol aksi (tidak tercetak) ── --}}
    <div class="action-bar">
        <a href="{{ route('arsip-surat.index') }}" class="btn btn-back">
            ← Kembali ke Arsip
        </a>
        <button class="btn btn-print" onclick="window.print()">
            🖨️ Print QR Code
        </button>
    </div>

    {{-- ── Kartu yang dicetak ── --}}
    <div class="card">

        {{-- Header --}}
        <p class="org-label">HIMADIKTI &mdash; Arsip Digital</p>
        <h1 class="title">Upload Surat</h1>
        <p class="subtitle">
            Scan QR di bawah ini untuk langsung membuka<br>
            <strong>Form Pengarsipan Surat</strong> HIMADIKTI
        </p>

        {{-- QR Code --}}
        <div class="qr-wrapper">
            <div id="qrcode"></div>
        </div>

        {{-- Instruksi --}}
        <p class="instruction">
            📱 Arahkan kamera HP ke QR code ini<br>
            Anda akan langsung diarahkan ke
            <span class="highlight">Form Upload Surat</span>
            <span class="note">⚠️ Login akun pengurus diperlukan terlebih dahulu</span>
        </p>

        <hr class="divider">

        {{-- URL --}}
        <div class="url-box">{{ $uploadUrl }}</div>

        {{-- Badge --}}
        <div>
            <span class="login-badge">
                🔐 Khusus Pengurus HIMADIKTI
            </span>
        </div>

        <hr class="divider">

        {{-- Footer --}}
        <p class="footer-note">
            Dicetak oleh: <strong>{{ auth()->user()->name }}</strong><br>
            {{ now()->translatedFormat('l, d F Y \p\u\k\u\l H:i') }} WIB
        </p>

    </div>

    <script>
        new QRCode(document.getElementById("qrcode"), {
            text: "{{ $uploadUrl }}",
            width: 224,
            height: 224,
            colorDark: "#111827",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H  // error correction tinggi
        });
    </script>

</body>
</html>