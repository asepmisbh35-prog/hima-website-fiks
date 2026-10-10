import re

with open('resources/views/landing.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# ===== 1. ABOUT CAROUSEL =====
start = content.find('<!-- Slide 1 -->')
end = content.find('<div id="carouselDots"')
old_about = content[start:end]

new_about = '''@php $aboutPhotos = \\App\\Models\\LandingPhoto::section('about')->get(); @endphp
                    @forelse($aboutPhotos as $i => $ap)
                    <div class="carousel-slide {{ $i === 0 ? 'active' : '' }}">
                        <img src="{{ $ap->photo_url }}" alt="{{ $ap->title }}" class="w-full h-full object-cover">
                    </div>
                    @empty
                    <div class="carousel-slide active">
                        <img src="/images/pp.jpg" alt="HIMADIKTI" class="w-full h-full object-cover">
                    </div>
                    @endforelse

                    '''
content = content.replace(old_about, new_about)
print("1. About carousel: patched")

# ===== 2. TEAM INTI (Pengurus Inti) =====
start = content.find('<div class="himadikti-slide-track" id="track-inti">') + len('<div class="himadikti-slide-track" id="track-inti">')
end = content.find('</div>\n                </div>\n                <button onclick="slide(\'inti\'')
old_inti = content[start:end]

new_inti = '''
                        @php $teamInti = \\App\\Models\\LandingPhoto::section('team_inti')->get(); @endphp
                        @foreach($teamInti as $i => $m)
                        <div class="shrink-0 w-[calc(100%-16px)] md:w-[calc(50%-16px)] lg:w-[calc(33.333%-16px)] mx-2 himadikti-reveal">
                            <div class="card-inti">
                                <div class="card-img-portrait"><img src="{{ $m->photo_url }}" alt="{{ $m->title }}"/>
                                    <div class="gradient-overlay"></div><div class="badge-overlay"><span class="badge-inti">Inti</span></div>
                                </div>
                                <div class="card-body"><h3 class="card-name">{{ $m->title }}</h3><p class="card-role">{{ $m->subtitle }}</p>
                                    <div class="flex gap-2 mt-2"><a href="#" class="social-btn">in</a><a href="#" class="social-btn">ig</a></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    '''
content = content.replace(old_inti, new_inti)
print("2. Team inti: patched")

# ===== 3. KETUA DIVISI array =====
start = content.find("$ketua_divisi = [")
end = content.find("@endphp", start) + len("@endphp")
old_kadiv = content[start:end]

new_kadiv = '''$ketua_divisi = \\App\\Models\\LandingPhoto::section('team_divisi')->get()->map(function($m) {
                                return ['name' => $m->title, 'role' => $m->subtitle, 'img' => $m->photo_url];
                            });
                        @endphp'''
content = content.replace(old_kadiv, new_kadiv)
print("3. Ketua divisi array: patched")

# ===== 4. DIVISI CARDS array =====
start = content.find("$divisi = [")
end = content.find("@endphp", start) + len("@endphp")
old_divisi = content[start:end]

new_divisi = '''$divisi = \\App\\Models\\LandingPhoto::section('divisi')->get()->map(function($m) {
                        return ['name' => $m->title, 'slug' => $m->link, 'img' => $m->photo_url, 'desc' => $m->description];
                    });
                @endphp'''
content = content.replace(old_divisi, new_divisi)
print("4. Divisi cards array: patched")

# ===== 5. PRESTASI CAROUSEL =====
start = content.find('<div class="auto-slide')
end = content.find('</section>\n<div class="py-8 bg-[#050505]"')
old_prestasi = content[start:end]

new_prestasi = '''@php $prestasiPhotos = \\App\\Models\\LandingPhoto::section('prestasi')->get(); @endphp
                @forelse($prestasiPhotos as $i => $pp)
                <div class="auto-slide absolute inset-0 transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                    <img src="{{ $pp->photo_url }}" alt="{{ $pp->title }}" class="w-full h-full object-cover object-top">
                </div>
                @empty
                <div class="auto-slide absolute inset-0 transition-opacity duration-1000 opacity-100 z-10">
                    <img src="/images/himadikti.png" alt="Prestasi" class="w-full h-full object-cover object-top">
                </div>
                @endforelse

            </div>
        </div>
    </div>

'''
content = content.replace(old_prestasi, new_prestasi)
print("5. Prestasi carousel: patched")

with open('resources/views/landing.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("\nSELESAI. landing.blade.php berhasil dipatch.")
