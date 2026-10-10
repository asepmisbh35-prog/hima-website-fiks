<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Aspirasi HIMADIKTI</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background-color: #ea580c; padding: 30px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 24px; font-weight: bold; letter-spacing: 1px; }
        .content { padding: 40px 30px; color: #3f3f46; line-height: 1.6; }
        .greeting { font-size: 18px; font-weight: 600; color: #18181b; margin-bottom: 20px; }
        .status-badge { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }
        .status-menunggu { background-color: #fef3c7; color: #92400e; }
        .status-diproses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }
        .status-ditolak { background-color: #fee2e2; color: #991b1b; }
        .box { background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .box-title { font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: bold; margin-bottom: 8px; }
        .tanggapan-box { border-left: 4px solid #ea580c; background-color: #fff7ed; padding: 20px; border-radius: 0 8px 8px 0; margin-top: 25px; }
        .tanggapan-title { font-weight: bold; color: #ea580c; margin-bottom: 10px; font-size: 14px; text-transform: uppercase; }
        .footer { background-color: #18181b; padding: 20px; text-align: center; color: #a1a1aa; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>HIMADIKTI IPI</h1>
        </div>
        
        <div class="content">
            <div class="greeting">Halo, {{ $aspirasi->pengirim_nama }}! 👋</div>
            
            <p>Terima kasih telah menyuarakan pendapatmu. Pesan aspirasi yang Anda kirimkan kepada HIMA PTI telah mendapatkan pembaruan status.</p>

            @php
                $statusClass = 'status-' . strtolower($aspirasi->status);
            @endphp

            <div>
                <span class="status-badge {{ $statusClass }}">Status: {{ $aspirasi->status }}</span>
            </div>

            <div class="box">
                <div class="box-title">Aspirasi Anda (Kategori: {{ $aspirasi->kategori }})</div>
                <div style="color: #475569; font-style: italic;">
                    "{{ $aspirasi->isi_aspirasi }}"
                </div>
            </div>

            @if($aspirasi->tanggapan)
                <div class="tanggapan-box">
                    <div class="tanggapan-title">Balasan dari Pengurus:</div>
                    <div style="color: #1f2937; line-height: 1.7;">
                        {!! nl2br(e($aspirasi->tanggapan)) !!}
                    </div>
                </div>
            @endif

            <p style="margin-top: 30px;">
                Jika ada hal lain yang ingin disampaikan, jangan ragu untuk mengirimkan aspirasi kembali melalui website kami.
            </p>
            
            <p style="margin-top: 30px;">Salam hangat,<br><strong>Pengurus HIMADIKTI</strong></p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Himpunan Mahasiswa Pendidikan Teknologi Informasi.<br>
            Pesan ini dikirim secara otomatis. Mohon tidak membalas email ini.
        </div>
    </div>
</body>
</html>