<?php
use App\Http\Controllers\LandingPhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\ArsipDokumenController;
use App\Http\Controllers\AgendaKegiatanController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\MonitoringProkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;

/*
|--------------------------------------------------------------------------
| 🏠 HOME & PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
if (auth()->check()) {
return redirect()->route('dashboard');
}
return view('landing');
})->name('home');

/*
|--------------------------------------------------------------------------
| 📝 ASPIRASI - Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/aspirasi', [AspirasiController::class, 'create'])->name('aspirasi.create');
Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');

/*
|--------------------------------------------------------------------------
| 👥 PENDAFTARAN PENGURUS - Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

/*
|--------------------------------------------------------------------------
| 📄 ARSIP SURAT - Public Routes (Semua orang bisa upload & lihat)
| PENTING: route statis (tanpa parameter) harus di atas route {arsipSurat}
|--------------------------------------------------------------------------
*/

Route::get('/arsip-surat', [ArsipSuratController::class, 'index'])->name('arsip-surat.index');
Route::get('/arsip-surat/qr-print', [ArsipSuratController::class, 'qrPrint'])->name('arsip-surat.qr-print');
Route::get('/arsip-surat/create', [ArsipSuratController::class, 'create'])->name('arsip-surat.create');
Route::post('/arsip-surat', [ArsipSuratController::class, 'store'])->name('arsip-surat.store');
Route::get('/arsip-surat/{arsipSurat}/download', [ArsipSuratController::class, 'download'])->name('arsip-surat.download');

/*
|--------------------------------------------------------------------------
| 📁 ARSIP DOKUMEN - Public Routes (Read & Download)
|--------------------------------------------------------------------------
*/

Route::get('/arsip-dokumen', [ArsipDokumenController::class, 'index'])->name('arsip-dokumen.index');
Route::get('/arsip-dokumen/{arsipDokumen}/download', [ArsipDokumenController::class, 'download'])->name('arsip-dokumen.download');
Route::get('/arsip-dokumen/{arsipDokumen}/preview', [ArsipDokumenController::class, 'preview'])->name('arsip-dokumen.preview');
Route::get('/arsip-dokumen/{arsipDokumen}/history', [ArsipDokumenController::class, 'history'])->name('arsip-dokumen.history');

/*
|--------------------------------------------------------------------------
| 📅 AGENDA KEGIATAN - Public Routes (Read Only)
|--------------------------------------------------------------------------
*/

Route::get('/agenda', [AgendaKegiatanController::class, 'index'])->name('agenda.index');

/*
|--------------------------------------------------------------------------
| 🔐 AUTHENTICATED ROUTES (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
// ========================================
// DASHBOARD & PROFILE
// ========================================

Route::get('/dashboard', function () {
$riwayatAspirasi = collect();
if (!auth()->user()->isPengurus()) {
$riwayatAspirasi = \App\Models\Aspirasi::where('user_id', auth()->id())
->latest()
->take(5)
->get();
}

return view('dashboard', compact('riwayatAspirasi'));
})->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// ========================================
// PENDAFTARAN (Mahasiswa - Login Required)
// ========================================

Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

/*
|--------------------------------------------------------------------------
| 👔 PENGURUS ROUTES (Pengurus Harian & Inti)
|--------------------------------------------------------------------------
*/

Route::middleware(['role:pengurus_harian,pengurus_inti'])->group(function () {

// ========================================
// 📝 KELOLA ASPIRASI
// ========================================

Route::get('/aspirasi/dashboard', [AspirasiController::class, 'dashboard'])->name('aspirasi.dashboard');
Route::patch('/aspirasi/{aspirasi}/status', [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');

// ========================================
// 👥 KELOLA PENDAFTARAN
// ========================================

Route::get('/pendaftaran/dashboard', [PendaftaranController::class, 'dashboard'])->name('pendaftaran.dashboard');
Route::patch('/pendaftaran/{pendaftaran}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
Route::get('/pendaftaran/{pendaftaran}/cv', [PendaftaranController::class, 'downloadCV'])->name('pendaftaran.downloadCV');

Route::patch('/pendaftaran/periode/{periode}/toggle', [PendaftaranController::class, 'periodeToggle'])
->name('pendaftaran.periode.toggleStatus');

Route::get('/pendaftaran/periode/{periode}/report-pdf', [PendaftaranController::class, 'reportPeriode'])
->name('pendaftaran.periode.reportPdf');

// ========================================
// 📄 ARSIP SURAT - Report (Pengurus only)
// create & store sudah dipindah ke public routes
// ========================================

Route::get('/arsip-surat/report', [ArsipSuratController::class, 'report'])->name('arsip-surat.report');

// ========================================
// 📁 ARSIP DOKUMEN - Create
// ========================================

Route::get('/arsip-dokumen/create', [ArsipDokumenController::class, 'create'])->name('arsip-dokumen.create');
Route::post('/arsip-dokumen', [ArsipDokumenController::class, 'store'])->name('arsip-dokumen.store');
Route::get('/arsip-dokumen/{arsipDokumen}/edit', [ArsipDokumenController::class, 'edit'])->name('arsip-dokumen.edit');
Route::patch('/arsip-dokumen/{arsipDokumen}', [ArsipDokumenController::class, 'update'])->name('arsip-dokumen.update');
Route::delete('/arsip-dokumen-bulk', [ArsipDokumenController::class, 'bulkDestroy'])->name('arsip-dokumen.bulkDestroy');
Route::patch('/arsip-dokumen-bulk-kategori', [ArsipDokumenController::class, 'bulkUpdateKategori'])->name('arsip-dokumen.bulkUpdateKategori');

// ========================================
// 📅 AGENDA KEGIATAN - Create & Edit
// ========================================

Route::get('/agenda/create', [AgendaKegiatanController::class, 'create'])->name('agenda.create');
Route::post('/agenda', [AgendaKegiatanController::class, 'store'])->name('agenda.store');
Route::get('/agenda/{agenda}/edit', [AgendaKegiatanController::class, 'edit'])->name('agenda.edit');
Route::patch('/agenda/{agenda}', [AgendaKegiatanController::class, 'update'])->name('agenda.update');

// ========================================
// 📋 MANAJEMEN RAPAT & NOTULENSI
// ========================================

Route::get('/rapat', [RapatController::class, 'index'])->name('rapat.index');
Route::get('/rapat/create', [RapatController::class, 'create'])->name('rapat.create');
Route::post('/rapat', [RapatController::class, 'store'])->name('rapat.store');
Route::get('/rapat/{rapat}', [RapatController::class, 'show'])->name('rapat.show');
Route::get('/rapat/{rapat}/edit', [RapatController::class, 'edit'])->name('rapat.edit');
Route::patch('/rapat/{rapat}', [RapatController::class, 'update'])->name('rapat.update');
Route::patch('/rapat/{rapat}/status', [RapatController::class, 'updateStatus'])->name('rapat.updateStatus');
Route::get('/rapat/{rapat}/notulensi', [RapatController::class, 'downloadNotulensi'])->name('rapat.downloadNotulensi');

// ========================================
// 📊 MANAJEMEN PROKER & MONITORING
// ========================================

Route::get('/proker', [ProkerController::class, 'index'])->name('proker.index');
Route::get('/proker/create', [ProkerController::class, 'create'])->name('proker.create');
Route::post('/proker', [ProkerController::class, 'store'])->name('proker.store');
Route::get('/proker/{proker}', [ProkerController::class, 'show'])->name('proker.show');
Route::get('/proker/{proker}/edit', [ProkerController::class, 'edit'])->name('proker.edit');
Route::patch('/proker/{proker}', [ProkerController::class, 'update'])->name('proker.update');
Route::patch('/proker/{proker}/upload-laporan', [ProkerController::class, 'uploadLaporan'])->name('proker.upload-laporan');

// Monitoring Proker
Route::post('/proker/{proker}/monitoring', [MonitoringProkerController::class, 'store'])->name('monitoring.store');
});

/*
|--------------------------------------------------------------------------
| 👑 PENGURUS INTI ONLY ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['role:pengurus_inti'])->group(function () {

// ========================================
// 📝 ASPIRASI - Delete
// ========================================

Route::delete('/aspirasi/{aspirasi}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');

// ========================================
// 👥 PERIODE PENDAFTARAN - Management
// ========================================

Route::get('/pendaftaran/periode', [PendaftaranController::class, 'periodeIndex'])->name('pendaftaran.periode.index');
Route::get('/pendaftaran/periode/create', [PendaftaranController::class, 'periodeCreate'])->name('pendaftaran.periode.create');
Route::post('/pendaftaran/periode', [PendaftaranController::class, 'periodeStore'])->name('pendaftaran.periode.store');

Route::get('/pendaftaran/periode/{periode}/edit', [PendaftaranController::class, 'periodeEdit'])->name('pendaftaran.periode.edit');
Route::patch('/pendaftaran/periode/{periode}/toggle', [PendaftaranController::class, 'periodeToggle'])->name('pendaftaran.periode.toggleStatus');
Route::patch('/pendaftaran/periode/{periode}/update', [PendaftaranController::class, 'periodeUpdate'])->name('pendaftaran.periode.update');

// ========================================
// 👤 USER MANAGEMENT
// ========================================

Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

// ========================================
// 📄 ARSIP SURAT - Edit & Delete (Inti only)
// ========================================

Route::get('/arsip-surat/{arsipSurat}/edit', [ArsipSuratController::class, 'edit'])->name('arsip-surat.edit');
Route::patch('/arsip-surat/{arsipSurat}', [ArsipSuratController::class, 'update'])->name('arsip-surat.update');
Route::delete('/arsip-surat/{arsipSurat}', [ArsipSuratController::class, 'destroy'])->name('arsip-surat.destroy');

// ========================================
// 📁 ARSIP DOKUMEN - Delete
// ========================================

Route::delete('/arsip-dokumen/{arsipDokumen}', [ArsipDokumenController::class, 'destroy'])->name('arsip-dokumen.destroy');

// ========================================
// 📅 AGENDA KEGIATAN - Delete
// ========================================

Route::delete('/agenda/{agenda}', [AgendaKegiatanController::class, 'destroy'])->name('agenda.destroy');

// ========================================
// 📋 RAPAT - Delete
// ========================================

Route::delete('/rapat/{rapat}', [RapatController::class, 'destroy'])->name('rapat.destroy');

// ========================================
// 📊 PROKER - Delete
// ========================================

Route::delete('/proker/{proker}', [ProkerController::class, 'destroy'])->name('proker.destroy');
});

Route::middleware(['role:pengurus_inti'])->prefix('admin/landing-photos')->name('admin.landing-photos.')->group(function () {
    Route::get('/', [LandingPhotoController::class, 'index'])->name('index');
    Route::get('/create', [LandingPhotoController::class, 'create'])->name('create');
    Route::post('/', [LandingPhotoController::class, 'store'])->name('store');
    Route::get('/{landingPhoto}/edit', [LandingPhotoController::class, 'edit'])->name('edit');
    Route::put('/{landingPhoto}', [LandingPhotoController::class, 'update'])->name('update');
    Route::delete('/{landingPhoto}', [LandingPhotoController::class, 'destroy'])->name('destroy');
    Route::post('/reorder', [LandingPhotoController::class, 'reorder'])->name('reorder');
});
});

//========================================
// DIVISI - Public Route (Read Only)
//========================================
Route::get('/divisi/{slug}', function ($slug) {

$semua_divisi = [

'divisi-it' => [
'name' => 'Divisi Teknologi & Informasi',
'desc' => '"Arsitek ekosistem digital, mentransformasi gagasan menjadi inovasi teknologi tanpa batas."',
'img' => 'https://instagram.fbdo3-1.fna.fbcdn.net/v/t51.82787-15/567124221_18295440358280335_1951375961188100531_n.heic?stp=dst-jpg_e35_tt6&_nc_cat=100&ig_cache_key=Mzc0NDc2NjU3ODUxMzgwNjExMw%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6InhwaWRzLjE0NDB4MTgwMC5zZHIuQzMifQ%3D%3D&_nc_ohc=xHT7z2kVEQUQ7kNvwGWp5-C&_nc_oc=Adq3qzgE9pRDblpZLL7A9JmjuDpsVkT77EViaz68WEz2K0_C9AtO1kzv5qdUH47qLNTTCTShOCDv8t5tmn0BKods&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fbdo3-1.fna&_nc_gid=FmTETdUMykes_5RKnj0OzA&_nc_ss=7a22e&oh=00_Af3VoiJUXrVbWEUrYyxHMdilqZWEE-OoWaiSev24Jgy9Nw&oe=69F2EF7A',
'prokers' => [
['title' => 'pelatihan Editing (Creative Visual Mastery)', 'detail' => 'Wadah inkubasi kreatif yang didedikasikan untuk mengasah keahlian multimedia dan komunikasi visual. program ini bertujuan mencetak kreator andal yang mampu mengemas gagasan edukatif serta informasi organisasi menjadi konten visual yang memukau, dinamis, dan relevan dengan audiens masa kini.', 'icon' => '🎬'],
['title' => 'Workshop Marketing Bisnis', 'detail' => 'Program akselerasi kewirausahaan yang dirancang untuk membangun insting bisnis dan keahlian pemasaran digital. Workshop ini mengupas tuntas strategi branding, riset pasar, hingga taktik konversi penjualan di era digital. ', 'icon' => '🚀'],
['title' => 'Manajemen Media Sosial<br>(Digital Branding & Engagement)', 'detail' => 'Pengelolaan strategis seluruh saluran media sosial HIMADIKTI sebagai etalase digital dan corong komunikasi utama organisasi. Program ini tidak hanya berfokus pada rutinitas publikasi informasi,dan pembuatan konten kreatif yang relevan', 'icon' => '📱'],
],
'staffs' => [
['name' => 'Moch. Andhika Ramdani s', 'role' => 'Ketua Divisi', 'photo' => asset('images/kadiv/it.jpg')],
['name' => 'Muhammad Faiz Rizkullohi ', 'role' => 'Anggota', 'photo' => asset('images/anggota/faiz.jpg')],
['name' => 'Salma Rahayu', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/it1.jpg')],
['name' => 'Anisa Nur Azfa', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/it-Anisa.jpg')],
['name' => 'Rizwa Rahmatunisa', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/it-Rizwa.jpg')],
['name' => 'Agung Nurjaman', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Agung+Nurjaman')],
['name' => 'Mikal Khairul Rahman', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Mikal+Khairul+Rahman')],
['name' => 'Dzahwan Purnama', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Dzahwan+Purnama')],
['name' => 'Reja', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Reja')],
]
],
'divisi-sosial-budaya' => [
'name' => 'Divisi Sosial & Budaya',
'desc' => '"Merawat kekayaan tradisi sebagai akar identitas, menumbuhkan empati yang tulus antarsesama, serta merajut sinergi kemanusiaan dalam setiap langkah pengabdian."',
'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&q=80',
'prokers' => [
['title' => 'Paturay Tineung', 'detail' => 'Malam inagurasi penuh makna sebagai bentuk apresiasi dan penghormatan bagi kakak tingkat yang telah menyelesaikan masa studi. Program ini merayakan kelulusan wisudawan sekaligus mempererat ikatan kekeluargaan lintas generasi demi menjaga relasi alumni berkelanjutan', 'icon' => '🎓'],
['title' => 'Diesnatalis', 'detail' => 'Perayaan akbar hari jadi HIMADIKTI sebagai momentum refleksi dan eskalasi semangat organisasi. Rangkaian kegiatannya memadukan unsur edukasi, kompetisi, serta apresiasi seni budaya guna membuktikan eksistensi organisasi sekaligus merayakan solidaritas dalam satu harmoni kebersamaan.', 'icon' => '🎂'],
['title' => 'Pengabdian Pada Masyarakat', 'detail' => 'Implementasi tridarma perguruan tinggi untuk membawa dampak positif bagi lingkungan melalui kegiatan sosial berkelanjutan dan pemberdayaan masyarakat. Program ini berkomitmen mencetak generasi cerdas intelektual yang memiliki kepekaan serta tanggung jawab sosial yang tinggi.', 'icon' => '🌱'],
['title' => '-', 'detail' => '-', 'icon' => '🎭'],
['title' => 'Jelajah Budaya & Literasi', 'detail' => 'Program edukasi interaktif yang membawa mahasiswa mengamati kebudayaan langsung melalui kunjungan sejarah serta diskusi literasi. Kegiatan ini bertujuan memperluas wawasan terhadap kearifan lokal Nusantara agar tetap terjaga dan tidak luntur tergerus arus modernisasi.', 'icon' => '🗺️'],
['title' => '-', 'detail' => '-', 'icon' => '🎭'],
],
'staffs' => [
['name' => ' restu', 'role' => 'Ketua Divisi', 'photo' => asset('image/kadiv/sos.jpg')],
['name' => ' Riska Siti Awalunisa', 'role' => 'Anggota', 'photo' => 'https://ui-avatars.com/api/?name=Siti+Aminah'],
['name' => 'Fryanka Ursula Ka`bah', 'role' => 'Anggota Muda', 'photo' => 'images/anggota/muda/sos.jpg'],
['name' => 'Alya Fitria', 'role' => 'Anggota Muda', 'photo' => 'images/anggota/muda/sos (1).jpg'],
['name' => 'Alika Aprillia M P', 'role' => 'Anggota Muda', 'photo' => 'images/anggota/muda/sos (2).jpg'],
['name' => 'Lailatul Zulfa', 'role' => 'Anggota Muda', 'photo' => 'images/anggota/muda/sos (3).jpg'],
['name' => 'Asti Lestari ', 'role' => 'Anggota Muda', 'photo' => 'images/anggota/muda/sos (4).jpg'],
['name' => 'Amelia Okta R ', 'role' => 'Anggota Muda', 'photo' => 'images/anggota/muda/sos (5).jpg'],
]
],
'divisi-jasmani-rohani' => [
'name' => 'Divisi Jasmani & Rohani',
'desc' => 'Sehat raganya, kuat jiwanya, seimbang hidupnya.',
'img' => 'https://instagram.fbdo3-1.fna.fbcdn.net/v/t51.82787-15/565337139_18295440508280335_4671716047959165151_n.heic?stp=dst-jpg_e35_tt6&_nc_cat=104&ig_cache_key=Mzc0NDc2Nzk3NTMxNzcxNjE3NQ%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6InhwaWRzLjE0NDB4MTgwMC5zZHIuQzMifQ%3D%3D&_nc_ohc=UzPn2lA-R7oQ7kNvwEkxCAR&_nc_oc=Ado2T0DyGuKsuaMR5VQMhCpHS7Qt_zfBhJNTRZwNtIhwi8xjBUSpNQ4-f4xN50ItBAFEmJwypXAMkgz1p61AxSZ1&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fbdo3-1.fna&_nc_gid=FmTETdUMykes_5RKnj0OzA&_nc_ss=7a22e&oh=00_Af2_wQqjcaoEr9-wKEdS_4Q0TI5xIL5ox9t6lu-azFT0DA&oe=69F2E4E9',
'prokers' => [
['title' => 'Ramadan Berbagi', 'detail' => 'Program aksi sosial tahunan melalui penyaluran bantuan dan buka puasa bersama untuk mempererat kepedulian antarsasama. Kegiatan ini bertujuan meningkatkan amal ibadah sekaligus memperkokoh tali silaturahmi antara pengurus HIMADIKTI dengan masyarakat luas secara nyata.', 'icon' => '🌙'],
['title' => 'Paskil HIMA', 'detail' => 'Wadah pembinaan iman melalui kajian intensif dan diskusi keagamaan untuk membentuk karakter mahasiswa yang berakhlak mulia. Program ini dirancang guna memperdalam pemahaman spiritual serta memperkuat ukhuwah islamiyah antaranggota dalam suasana yang edukatif dan religius.', 'icon' => '📖'],
['title' => 'Doa Bersama', 'detail' => 'Forum refleksi kolektif untuk memohon kelancaran agenda organisasi serta kesuksesan akademik anggota. Melalui doa bersama, tercipta suasana kerja yang harmonis dan penuh keberkahan, sekaligus memperkuat mental spiritual pengurus dalam menjalankan amanah selama satu periode.', 'icon' => '🤲'],
['title' => ' -.', 'detail' => '.', 'icon' => '👩‍⚖️'],
['title' => 'Tadzabur Alam', 'detail' => 'Kegiatan wisata religi di alam terbuka untuk mensyukuri keagungan ciptaan Tuhan melalui pengamatan semesta secara langsung. Proker ini berfungsi menyegarkan pikiran anggota, membangun rasa syukur, serta mempererat persaudaraan dalam lingkungan yang asri dan inspiratif.', 'icon' => '🌲'],
['title' => ' -.', 'detail' => '.', 'icon' => '👩‍⚖️'],
],
'staffs' => [
['name' => ' Naufal Dafa Khoiron ', 'role' => 'Ketua Divisi', 'photo' => asset('image/kadiv/jasmani-rohani.jpg')],
['name' => ' Raditia Fajar Pratama', 'role' => 'Anggota', 'photo' => asset('images/anggota/harian/radit.jpg')],
['name' => ' Tazkia Inayah', 'role' => 'Anggota', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Tatiana Awalura A', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/jasro (1).jpg')],
['name' => ' Firgiansya N A', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/jasro (2).jpg')],
['name' => ' Syifa Nurzimah', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/jasro (3).jpg')],
['name' => ' Ananda Nuri Nurasiah', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/jasro (4).jpg')],
['name' => ' Meyliza Rosmalia Putri', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/jasro (5).jpg')],
['name' => ' Ai Fitri Sobriah', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/muda/jasro (6).jpg')],
['name' => ' Alya Syara Shafira', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Alya+Syara+Shafira')],
['name' => ' Amanda Fatiatul L', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Amanda+Fatiatul+L')]
]
],
'divisi-minat-bakat' => [
'name' => 'Divisi Minat & Bakat',
'desc' => '"Menjadi ruang tanpa batas untuk berekspresi, menggali potensi terpendam dalam diri, serta membina setiap bakat menjadi prestasi gemilang yang menginspirasi."',
'img' => asset('images/proker/minkat.jpg'),
'prokers' => [
['title' => 'Pelatihan Olahraga ', 'detail' => 'Program pembinaan dan latihan fisik rutin yang dirancang untuk memfasilitasi mahasiswa dalam mengasah kemampuan teknis di berbagai cabang olahraga. Lebih dari sekadar ajang mencari keringat, pelatihan ini menghadirkan sesi coaching clinic untuk mendalami strategi, taktik, dan kedisiplinan secara komprehensif. Tujuannya adalah membangun budaya hidup sehat, memupuk kerja sama tim, sekaligus mempersiapkan kontingen atlet andal yang siap mewakili serta mengharumkan nama HIMADIKTI di berbagai kejuaraan eksternal.', 'icon' => '🏃'],
['title' => 'HIMA-CUP (Pekan Olahraga & Solidaritas)', 'detail' => 'Turnamen olahraga bergengsi antarmahasiswa yang mempertandingkan berbagai cabang olahraga populer (seperti futsal, basket, atau bulu tangkis). HIMA-CUP dirancang bukan hanya untuk mencari juara, tetapi untuk membakar semangat sportivitas, memperkuat solidaritas, dan menjaga kebugaran fisik pengurus maupun anggota.', 'icon' => '🏆'],
['title' => 'Laga Persahabatan (HIMA-Sparring)', 'detail' => 'Kegiatan pertandingan olahraga uji coba yang dilakukan dengan himpunan mahasiswa dari jurusan, fakultas, atau bahkan universitas lain. Proker ini tidak memprioritaskan perebutan gelar juara, melainkan difokuskan untuk memperluas networking, bertukar pengalaman, dan membangun diplomasi yang baik antarorganisasi melalui medium olahraga.', 'icon' => '🎨'],
],
'staffs' => [
['name' => ' Deswita ', 'role' => 'Ketua Divisi', 'photo' => asset('image/kadiv/minkat.jpg')],
['name' => ' Anajiah', 'role' => 'Sekertaris Divisi', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Novia', 'role' => 'Bendahara Divisi', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Ismi', 'role' => 'Anggota', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Amelia', 'role' => 'Anggota', 'photo' => asset('images/anggota/angjas.jpg')],
]
],
'divisi-advokasi' => [
'name' => 'Divisi Advokasi',
'desc' => '"Menjadi garda terdepan pelindung hak mahasiswa, mengawal keadilan konstitusi, serta membangun sinergi lintas batas demi kemajuan organisasi."',
'img' => asset('images/proker/advo.jpg'),
'prokers' => [
['title' => 'Kajian Undang-Undang Himadikti', 'detail' => 'Forum diskursus dan analisis strategis yang berfokus pada evaluasi, serta harmonisasi konstitusi dan produk hukum organisasi (seperti AD/ART atau Peraturan Organisasi). memastikan landasan hukum organisasi tetap kokoh, adaptif, dan mampu menjadi pedoman yang tegas namun fleksibel bagi seluruh roda kepengurusan.', 'icon' => '⚖️'],
['title' => 'Study Banding', 'detail' => 'Program ekspedisi intelektual dan kolaborasi eksternal yang dilakukan dengan mengunjungi organisasi, himpunan, atau instansi lain di luar lingkup internal kampus. Studi banding bertujuan untuk melakukan benchmarking terhadap kualitas program kerja, bertukar inovasi tata kelola organisasi, dan memperluas relasi.', 'icon' => '🤝'],
['title' => 'Aspiration Channeling Hub', 'detail' => 'Program ini adalah jembatan komunikasi antara mahasiswa dan birokrasi kampus. Kami menampung, memverifikasi, dan meneruskan setiap aspirasi kepada pihak terkait. Setiap suara dan gagasan dipastikan tidak sekadar ditampung, tetapi dikawal tuntas hingga menghasilkan solusi konkret.', 'icon' => '📚'],
['title' => ' -.', 'detail' => '.', 'icon' => '👩‍⚖️'],
['title' => 'Mimbar Kritis & Diskusi Isu (Strategic Issue Forum)', 'detail' => 'Wadah diskursus intelektual untuk membedah isu-isu strategis, baik yang terjadi di lingkungan kampus maupun dinamika pendidikan nasional. Melalui mimbar ini, mahasiswa diajak berpikir kritis untuk merumuskan press release atau pernyataan sikap resmi organisasi.', 'icon' => '📰'],
['title' => ' -.', 'detail' => '.', 'icon' => '👩‍⚖️'],
],
'staffs' => [
['name' => ' Ferdiansyah ', 'role' => 'Ketua Divisi', 'photo' => asset('image/kadiv/minkat.jpg')],
['name' => ' Nabila Athaliah L', 'role' => 'Sekertaris Divisi', 'photo' => asset('images/anggota/nabila.jpg')],
['name' => ' Wahdan Wali Nurwahid', 'role' => 'Bendahara Divisi', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Siti Sumiyati', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Siti+Sumiyati')],
['name' => ' Nurul Aminatul', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Nurul+Aminatul')],
['name' => ' Muhammad Rifka Z', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Muhammad+Rifka+Z')],
['name' => ' M Yusuf Badar Sabili', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=M+Yusuf+Badar+Sabili')],
['name' => ' Andiana Jamaludin', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Andiana+Jamaludin')],
['name' => ' M. Fazri Aulia N', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=M.+Fazri+Aulia+N')],
]
],
'divisi-dana-usaha' => [
'name' => 'Divisi Dana Usaha<br>&<br>Kesekertariatan',
'desc' => '"Lebih dari sekadar tumpukan kertas, kami adalah pusat kendali administratif dan penjaga memori organisasi. Serta membangun kemandirian finansial melalui inovasi peluang usaha, strategi kemitraan yang solid, serta semangat kewirausahaan yang progresif"',
'img' => asset('images/proker/danus.jpg'),
'prokers' => [
['title' => 'Produk & Pemasaran Produk<BR> (HIMA-Merch & Branding)', 'detail' => 'Unit pengembangan usaha yang berfokus pada produksi dan distribusi atribut serta merchandise eksklusif HIMADIKTI. Tujuannya adalah memperkuat identitas organisasi, sekaligus menjadi salah satu pilar kemandirian finansial melalui optimalisasi brand HIMADIKTI.', 'icon' => '🛍️'],
['title' => 'Paribut', 'detail' => 'Paribut berfungsi sebagai laboratorium kewirausahaan yang dinamis, memfasilitasi Mahasiswa baru Terhadap kebutuhan - kebutuhan , serta mendorong semangat entrepreneurship pengurus melalui pengelolaan tenant dan aktivasi pasar yang seru di lingkungan kampus.', 'icon' => '📝'],
['title' => 'Partnership & Sponsorship Hub', 'detail' => 'Program strategis yang fokus pada pembangunan relasi jangka panjang dengan pihak eksternal, perusahaan, maupun instansi pemerintah. Divisi ini bertindak sebagai negosiator yang menawarkan ruang kolaborasi pemasaran melalui media publikasi organisasi.', 'icon' => '🤝'],
['title' => 'Inven-Track <br> (Monitoring Inventaris & Aset)', 'detail' => 'Sistem manajemen aset terintegrasi untuk mendata, melabeli, dan memantau seluruh inventaris fisik milik HIMADIKTI. Inven-Track memudahkan pelacakan status keberadaan barang, kondisi aset, hingga digitalisasi alur peminjaman.', 'icon' => '📦'],
['title' => 'E-Archive Center ', 'detail' => 'Digitalisasi seluruh dokumen organisasi (Surat Masuk/Keluar, Proposal, LPJ, dan Sertifikat) ke dalam database cloud di sistem SIM HIMADIKTI. Proker ini memastikan tidak ada lagi dokumen yang hilang dan memudahkan pencarian arsip lintas generasi kepengurusan.', 'icon' => '🗂️'],
['title' => 'Sekre Sweet Sekre (S3)', 'detail' => ' Kenyamanan fisik tetap utama. Proker ini fokus pada pemeliharaan kebersihan, tata letak, dan kenyamanan ruang kesekretariatan HIMADIKTI. Termasuk di dalamnya pembuatan jadwal piket harian pengurus untuk memastikan basecamp selalu kondusif sebagai tempat diskusi, merancang ide, atau sekadar beristirahat.', 'icon' => '🧹'],
],
'staffs' => [
['name' => ' Hildan Fatwa ', 'role' => 'Anggota', 'photo' => asset('image/kadiv/minkat.jpg')],
['name' => 'Yusuf Mustofa', 'role' => 'Ketua Divisi', 'photo' => asset('images/kadiv/kesek.jpg')],
['name' => 'Bayani Izati', 'role' => 'Anggota', 'photo' => asset('images/anggota/bayani.jpg')],
['name' => 'Swito Widianto', 'role' => 'Anggota', 'photo' => asset('images/anggota/angkes.jpg')],
['name' => 'Salsa Aulia Puptri', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Salsa+Aulia+Puptri')],
['name' => 'Putri Umrotul Mamuroh', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Putri+Umrotul+Mamuroh')],
['name' => 'Khopipah Lauri', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Khopipah+Lauri')],
['name' => 'Fauziah Putri R', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Fauziah+Putri+R')],
['name' => 'Septi Julianti', 'role' => 'Anggota Muda', 'photo' => asset('https://ui-avatars.com/api/?name=Septi+Julianti')],
]
],
'divisi-pendidikan' => [
'name' => 'divisi pendidikan & PSDM',
'desc' => '"Menginspirasi melalui ilmu, mencerdaskan melalui inovasi, dan membangun peradaban melalui dedikasi di dunia pendidikan."',
'img' => asset('images/proker/pendik.jpg'),
'prokers' => [
['title' => 'SOSHIMADIKTI', 'detail' => ' Program strategis memperkenalkan identitas, visi, serta peran HIMADIKTI kepada mahasiswa baru maupun pihak eksternal. SOSHIMADIKTI berfungsi sebagai media branding organisasi untuk membangun kedekatan, memperluas relasi, serta menumbuhkan minat partisipasi aktif mahasiswa dalam dinamika kampus.', 'icon' => '📁'],
['title' => 'Gebyar Festival', 'detail' => 'Ajang pesta rakyat dan puncak kreativitas yang memadukan unsur seni, budaya, dan kompetisi dalam satu rangkaian festival akbar. Kegiatan ini dirancang untuk menunjukkan eksistensi HIMADIKTI melalui panggung ekspresi yang meriah, dinamis, dan penuh semangat kolaborasi.', 'icon' => '🎆'],
['title' => 'Pelatihan Public Speaking', 'detail' => 'Workshop intensif pengembangan kemampuan komunikasi, kepercayaan diri, dan seni berbicara di depan publik. Materi mencakup teknik presentasi hingga retorika argumen guna membekali mahasiswa kependidikan agar mampu menyampaikan gagasan secara sistematis, persuasif, serta profesional.', 'icon' => '🎤'],
['title' => 'Pelantikan & Orientasi Pengurus Himadikti', 'detail' => 'Momentum peresmian legalitas pengurus baru HIMADIKTI yang memadukan prosesi sumpah jabatan dengan pembekalan komprehensif. Program ini mengenalkan budaya kerja, struktur, dan visi organisasi guna memastikan kesiapan mental serta komitmen penuh seluruh pengurus dalam menjalankan amanah.', 'icon' => '🤝'],
['title' => 'POLKM', 'detail' => 'Program kaderisasi berjenjang sebagai kawah candradimuka bagi calon penerus organisasi guna menanamkan kepemimpinan, etika, dan kemampuan pemecahan masalah. Melalui simulasi intensif, program ini mencetak kader tangguh yang visioner dan siap memegang tongkat estafet kepemimpinan.', 'icon' => '🚩'],
['title' => 'Leadership HIMA-Mentorship', 'detail' => 'Sistem pendampingan intensif yang memasangkan pengurus tetap dengan anggota baru guna mempercepat adaptasi dan kelancaran transfer ilmu. Program ini menyediakan ruang konsultasi personal terkait kendala organisasi maupun akademik demi menjamin pertumbuhan kualitas setiap individu.', 'icon' => '👥'],
],
'staffs' => [
['name' => ' Raras Rahma Rizqilah', 'role' => 'Ketua Divisi', 'photo' => asset('image/kadiv/minkat.jpg')],
['name' => ' Siti Arifah', 'role' => 'Sekertaris Divisi', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Nia Nisrina', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Wita Ristyani', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Ai Wini', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/angjas.jpg')],
['name' => ' Anisa', 'role' => 'Anggota Muda', 'photo' => asset('images/anggota/angjas.jpg')],
]
],
];

if (!array_key_exists($slug, $semua_divisi)) {
abort(404);
}

$data_divisi = $semua_divisi[$slug];

return view('divisi.show', ['data' => $data_divisi]);
})->name('divisi.show');

require __DIR__ . '/auth.php';
