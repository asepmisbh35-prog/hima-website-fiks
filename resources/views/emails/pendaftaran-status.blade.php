<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran HIMADIKTI</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f3f4f6; color: #1f2937; }
        .wrapper { max-width: 600px; margin: 40px auto; }
        
        /* Header */
        .header { background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); padding: 40px 32px; border-radius: 16px 16px 0 0; text-align: center; }
        .header-logo { width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px; }
        .header-logo span { color: white; font-size: 28px; font-weight: bold; }
        .header h1 { color: white; font-size: 24px; font-weight: 700; margin-bottom: 8px; }
        .header p { color: rgba(255,255,255,0.85); font-size: 14px; }

        /* Body */
        .body { background: white; padding: 40px 32px; }
        .greeting { font-size: 18px; font-weight: 600; color: #1f2937; margin-bottom: 16px; }
        .message { color: #6b7280; line-height: 1.7; margin-bottom: 28px; }

        /* Status Badge */
        .status-card { border-radius: 16px; padding: 28px; margin-bottom: 28px; text-align: center; }
        .status-card.diterima { background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 2px solid #6ee7b7; }
        .status-card.ditolak { background: linear-gradient(135deg, #fef2f2, #fee2e2); border: 2px solid #fca5a5; }
        .status-card.menunggu { background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 2px solid #fcd34d; }
        
        .status-icon { font-size: 48px; margin-bottom: 12px; }
        .status-title { font-size: 22px; font-weight: 700; margin-bottom: 6px; }
        .status-card.diterima .status-title { color: #065f46; }
        .status-card.ditolak .status-title { color: #991b1b; }
        .status-card.menunggu .status-title { color: #92400e; }
        .status-desc { font-size: 14px; }
        .status-card.diterima .status-desc { color: #059669; }
        .status-card.ditolak .status-desc { color: #ef4444; }

        /* Info Grid */
        .info-grid { background: #f9fafb; border-radius: 12px; padding: 24px; margin-bottom: 28px; border: 1px solid #e5e7eb; }
        .info-grid h3 { font-size: 13px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb; }
        .info-row:last-child { border-bottom: none; padding-bottom: 0; }
        .info-label { font-size: 13px; color: #6b7280; }
        .info-value { font-size: 13px; font-weight: 600; color: #1f2937; text-align: right; }
        .kode-badge { background: #ede9fe; color: #5b21b6; padding: 4px 12px; border-radius: 20px; font-family: monospace; font-size: 13px; }

        /* Catatan */
        .catatan-box { background: #eff6ff; border-left: 4px solid #3b82f6; border-radius: 0 12px 12px 0; padding: 20px; margin-bottom: 28px; }
        .catatan-box h3 { font-size: 13px; font-weight: 700; color: #1e40af; margin-bottom: 8px; }
        .catatan-box p { font-size: 14px; color: #1e3a8a; line-height: 1.6; }

        /* Next Steps */
        .steps { margin-bottom: 28px; }
        .steps h3 { font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 16px; }
        .step-item { display: flex; align-items: flex-start; margin-bottom: 12px; }
        .step-num { width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-right: 12px; margin-top: 2px; }
        .step-num.green { background: #d1fae5; color: #065f46; }
        .step-num.red { background: #fee2e2; color: #991b1b; }
        .step-text { font-size: 14px; color: #4b5563; line-height: 1.5; }

        /* CTA Button */
        .cta-section { text-align: center; margin-bottom: 28px; }
        .cta-btn { display: inline-block; padding: 14px 32px; border-radius: 12px; font-size: 15px; font-weight: 700; text-decoration: none; }
        .cta-btn.diterima { background: linear-gradient(135deg, #059669, #10b981); color: white; }
        .cta-btn.ditolak { background: linear-gradient(135deg, #4f46e5, #6366f1); color: white; }

        /* Footer */
        .footer { background: #f9fafb; padding: 28px 32px; border-radius: 0 0 16px 16px; text-align: center; border-top: 1px solid #e5e7eb; }
        .footer p { font-size: 12px; color: #9ca3af; line-height: 1.7; }
        .footer a { color: #6366f1; text-decoration: none; }
        .footer-brand { font-size: 16px; font-weight: 700; color: #4f46e5; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <div class="header-logo">
                <span>H</span>
            </div>
            <h1>HIMADIKTI</h1>
            <p>Himpunan Mahasiswa Pendidikan Teknologi Informasi</p>
        </div>

        <!-- Body -->
        <div class="body">
            <p class="greeting">Halo, {{ $pendaftaran->nama }}! 👋</p>
            <p class="message">
                Terima kasih telah mendaftar menjadi Pengurus Muda HIMADIKTI. 
                Berikut adalah informasi terkait status pendaftaran Anda.
            </p>

            <!-- Status Card -->
            @if($pendaftaran->status === 'diterima')
                <div class="status-card diterima">
                    <div class="status-icon">🎉</div>
                    <div class="status-title">Selamat! Anda Diterima</div>
                    <div class="status-desc">Pendaftaran Anda telah diverifikasi dan disetujui</div>
                </div>
            @elseif($pendaftaran->status === 'ditolak')
                <div class="status-card ditolak">
                    <div class="status-icon">😔</div>
                    <div class="status-title">Pendaftaran Tidak Diterima</div>
                    <div class="status-desc">Mohon maaf, pendaftaran Anda belum dapat kami terima saat ini</div>
                </div>
            @else
                <div class="status-card menunggu">
                    <div class="status-icon">⏳</div>
                    <div class="status-title">Sedang Diproses</div>
                    <div class="status-desc">Pendaftaran Anda sedang dalam proses review</div>
                </div>
            @endif

            <!-- Info Grid -->
            <div class="info-grid">
                <h3>Detail Pendaftaran</h3>
                <div class="info-row">
                    <span class="info-label">Kode Pendaftaran</span>
                    <span class="info-value"><span class="kode-badge">{{ $pendaftaran->kode_pendaftaran }}</span></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $pendaftaran->nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">NIM</span>
                    <span class="info-value">{{ $pendaftaran->nim }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Periode</span>
                    <span class="info-value">{{ $pendaftaran->periode->nama_periode }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Daftar</span>
                    <span class="info-value">{{ $pendaftaran->created_at->format('d M Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        @if($pendaftaran->status === 'diterima')
                            ✅ Diterima
                        @elseif($pendaftaran->status === 'ditolak')
                            ❌ Ditolak
                        @else
                            ⏳ Menunggu
                        @endif
                    </span>
                </div>
            </div>

            <!-- Catatan dari Pengurus -->
            @if($pendaftaran->catatan)
                <div class="catatan-box">
                    <h3>📝 Catatan dari Pengurus</h3>
                    <p>{{ $pendaftaran->catatan }}</p>
                </div>
            @endif

            <!-- Next Steps -->
            @if($pendaftaran->status === 'diterima')
                <div class="steps">
                    <h3>🚀 Langkah Selanjutnya:</h3>
                    <div class="step-item">
                        <div class="step-num green">1</div>
                        <div class="step-text">Login ke website HIMADIKTI dan cek dashboard Anda</div>
                    </div>
                    <div class="step-item">
                        <div class="step-num green">2</div>
                        <div class="step-text">Tunggu informasi lebih lanjut mengenai jadwal orientasi pengurus</div>
                    </div>
                    <div class="step-item">
                        <div class="step-num green">3</div>
                        <div class="step-text">Simpan kode pendaftaran Anda sebagai bukti penerimaan</div>
                    </div>
                </div>
                <div class="cta-section">
                    <a href="{{ url('/dashboard') }}" class="cta-btn diterima">
                        🎯 Lihat Dashboard Saya
                    </a>
                </div>
            @elseif($pendaftaran->status === 'ditolak')
                <div class="steps">
                    <h3>💡 Jangan Menyerah!</h3>
                    <div class="step-item">
                        <div class="step-num red">1</div>
                        <div class="step-text">Pelajari catatan dari pengurus untuk perbaikan ke depan</div>
                    </div>
                    <div class="step-item">
                        <div class="step-num red">2</div>
                        <div class="step-text">Tingkatkan kemampuan dan pengembangan diri Anda</div>
                    </div>
                    <div class="step-item">
                        <div class="step-num red">3</div>
                        <div class="step-text">Coba kembali di periode pendaftaran berikutnya</div>
                    </div>
                </div>
                <div class="cta-section">
                    <a href="{{ url('/pendaftaran') }}" class="cta-btn ditolak">
                        🔄 Cek Periode Berikutnya
                    </a>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-brand">HIMADIKTI</div>
            <p>
                Email ini dikirim secara otomatis oleh sistem HIMADIKTI.<br>
                Jika ada pertanyaan, hubungi kami di 
                <a href="mailto:hima.pti@univ.ac.id">hima.pti@univ.ac.id</a><br><br>
                © {{ date('Y') }} HIMADIKTI. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>