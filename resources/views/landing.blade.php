<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMADIKTI - Himpunan Mahasiswa Pendidikan Teknologi Informasi</title>

    <link rel="icon" type="image/png" href="{{ asset('images/himadikti.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800&family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                    },
                    colors: {
                        primary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                            950: '#431407',
                        },
                    },
                    keyframes: {
                        fadeUp: {
                            from: { opacity: '0', transform: 'translateY(24px)' },
                            to:   { opacity: '1', transform: 'translateY(0)' }
                        },
                        scrollDown: {
                            '0%':   { transform: 'scaleY(0)', transformOrigin: 'top' },
                            '50%':  { transform: 'scaleY(1)', transformOrigin: 'top' },
                            '51%':  { transform: 'scaleY(1)', transformOrigin: 'bottom' },
                            '100%': { transform: 'scaleY(0)', transformOrigin: 'bottom' },
                        },
                        fadeIn:  { from: { opacity: '0' }, to: { opacity: '1' } },
                        slideUp: { from: { transform: 'translateY(30px)', opacity: '0' }, to: { transform: 'translateY(0)', opacity: '1' } },
                    },
                    animation: {
                        'fade-up':    'fadeUp 0.6s ease forwards',
                        'fade-up-03': 'fadeUp 0.8s 0.3s forwards',
                        'fade-up-05': 'fadeUp 0.8s 0.5s forwards',
                        'fade-up-07': 'fadeUp 0.8s 0.7s forwards',
                        'fade-up-09': 'fadeUp 0.8s 0.9s forwards',
                        'fade-up-12': 'fadeUp 0.8s 1.2s forwards',
                        'scroll-down':'scrollDown 1.5s ease infinite',
                        'fade-in':    'fadeIn 0.3s ease',
                        'slide-up':   'slideUp 0.3s ease',
                    },
                },
            },
        }
    </script>

    <style>
        /* ===== KEYFRAMES ===== */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        @keyframes scrollDown {
            0%   { transform: scaleY(0); transform-origin: top; }
            50%  { transform: scaleY(1); transform-origin: top; }
            51%  { transform: scaleY(1); transform-origin: bottom; }
            100% { transform: scaleY(0); transform-origin: bottom; }
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }
        @keyframes marqueeProker {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        @keyframes tickerProker {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        /* ===== PROKER TEREALISASI — STYLES ===== */

        /* Filter pills */
        .pk-filter-btn {
            padding: 7px 18px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            border: 1.5px solid rgba(255,255,255,.12);
            color: rgba(255,255,255,.45);
            background: transparent;
            cursor: pointer;
            transition: all .25s ease;
            white-space: nowrap;
        }
        .pk-filter-btn:hover { border-color: rgba(234,88,12,.5); color: #ea580c; }
        .pk-filter-btn.pk-active {
            background: #ea580c;
            border-color: #ea580c;
            color: #fff;
            box-shadow: 0 6px 18px rgba(234,88,12,.35);
        }

        /* Grid cards */
        .pk-card {
            background: #0f0f0f;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 18px;
            overflow: hidden;
            transition: all .4s cubic-bezier(.23,1,.32,1);
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .pk-card:hover {
            border-color: rgba(234,88,12,.45);
            transform: translateY(-6px);
            box-shadow: 0 28px 60px rgba(234,88,12,.15), 0 0 0 1px rgba(234,88,12,.18);
        }
        .pk-card.pk-hidden { display: none; }

        /* Card image wrapper */
        .pk-img-wrap {
            position: relative;
            width: 100%;
            padding-bottom: 62%;
            overflow: hidden;
            background: #1a1a1a;
        }
        .pk-img-wrap img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s cubic-bezier(.23,1,.32,1), filter .4s;
            filter: brightness(.82) saturate(.9);
        }
        .pk-card:hover .pk-img-wrap img {
            transform: scale(1.07);
            filter: brightness(.6) saturate(1.15);
        }
        .pk-img-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,.55) 0%, transparent 22%, transparent 55%, rgba(0,0,0,.85) 100%);
            z-index: 1;
        }

        /* Badges */
        .pk-badge-divisi {
            position: absolute;
            top: 14px; left: 14px;
            z-index: 2;
            padding: 3px 11px;
            border-radius: 999px;
            font-size: 9px; font-weight: 800;
            letter-spacing: .12em; text-transform: uppercase;
            background: rgba(234,88,12,.22);
            border: 1px solid rgba(234,88,12,.5);
            color: #fb923c;
            backdrop-filter: blur(6px);
        }
        .pk-badge-selesai {
            position: absolute;
            top: 14px; right: 14px;
            z-index: 2;
            display: flex; align-items: center; gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 9px; font-weight: 800;
            letter-spacing: .08em; text-transform: uppercase;
            background: rgba(16,185,129,.18);
            border: 1px solid rgba(16,185,129,.4);
            color: #34d399;
            backdrop-filter: blur(6px);
        }
        .pk-badge-selesai::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #34d399;
            animation: pkPulse 1.8s ease-in-out infinite;
        }
        @keyframes pkPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .5; transform: scale(.7); }
        }

        /* Progress ring */
        .pk-ring { transform: rotate(-90deg); }
        .pk-ring-track { fill: none; stroke: rgba(255,255,255,.07); }
        .pk-ring-fill  {
            fill: none;
            stroke: #ea580c;
            stroke-linecap: round;
            stroke-dasharray: 94.2;
            stroke-dashoffset: 94.2;
            transition: stroke-dashoffset 1.2s cubic-bezier(.23,1,.32,1);
        }
        .pk-ring-fill.animated { stroke-dashoffset: 0; }

        /* Card body */
        .pk-body {
            padding: 16px 18px 18px;
            display: flex; flex-direction: column;
            flex: 1; gap: 8px;
        }
        .pk-title {
            font-family: sans-serif;
            font-weight: 800;
            font-size: clamp(13px, 1.6vw, 16px);
            color: #fff; line-height: 1.25;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .pk-ketua { font-size: 11px; color: rgba(255,255,255,.4); }
        .pk-ketua span { color: #fb923c; font-weight: 600; }
        .pk-desc {
            font-size: 12px; color: rgba(255,255,255,.45); line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .pk-footer {
            margin-top: auto; padding-top: 12px;
            border-top: 1px solid rgba(255,255,255,.06);
            display: flex; align-items: center;
            justify-content: space-between; gap: 8px;
        }
        .pk-meta {
            display: flex; align-items: center;
            gap: 5px; font-size: 10px;
            color: rgba(255,255,255,.3);
        }

        /* Hover shimmer */
        .pk-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(234,88,12,.06) 0%, transparent 60%);
            opacity: 0; transition: opacity .4s;
            z-index: 0; pointer-events: none;
        }
        .pk-card:hover::before { opacity: 1; }

        /* Counter */
        .pk-counter-val {
            font-family:    sans-serif;
            font-size: clamp(30px, 4vw, 48px);
            font-weight: 800; line-height: 1;
            color: #fff; display: block;
        }
        .pk-counter-val.accent { color: #fb923c; }

        /* Empty state */
        .pk-empty {
            grid-column: 1 / -1;
            padding: 60px 20px; text-align: center;
            border: 1px dashed rgba(255,255,255,.08);
            border-radius: 18px; color: rgba(255,255,255,.2);
        }

        /* Filter scroll mobile */
       .pk-filters-wrap {
    overflow-x: auto;
    overflow-y: visible;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding-bottom: 4px;
    -webkit-overflow-scrolling: touch;
    touch-action: pan-x;
    position: relative;
    z-index: 10;
}
.pk-filters-wrap::-webkit-scrollbar { display: none; }
.pk-filter-btn {
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    user-select: none;
    cursor: pointer;
}

        /* Load more */
        .pk-load-more {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 32px; border-radius: 999px;
            font-family: 'Syne', sans-serif;
            font-size: 13px; font-weight: 700;
            background: transparent;
            border: 1.5px solid rgba(234,88,12,.45);
            color: #fb923c; cursor: pointer;
            transition: all .3s; margin: 0 auto;
        }
        .pk-load-more:hover {
            background: #ea580c; color: #fff;
            border-color: #ea580c;
            box-shadow: 0 10px 30px rgba(234,88,12,.3);
            transform: translateY(-2px);
        }
        .pk-load-more.hidden { display: none; }

        /* ══ LIGHTBOX ══ */
        #pk-lightbox {
            display: none;
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            align-items: center; justify-content: center;
            padding: 20px;
            animation: pkFadeIn .25s ease;
        }
        #pk-lightbox.open { display: flex; }
        @keyframes pkFadeIn { from { opacity: 0; } to { opacity: 1; } }
        .pk-lb-inner {
            background: #111;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 24px; overflow: hidden;
            max-width: 680px; width: 100%;
            max-height: 90vh; overflow-y: auto;
            scrollbar-width: thin; scrollbar-color: #ea580c #1c1917;
            animation: pkSlideUp .3s cubic-bezier(.23,1,.32,1);
        }
        @keyframes pkSlideUp {
            from { transform: translateY(24px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .pk-lb-img-wrap {
            position: relative; width: 100%; padding-bottom: 58%; overflow: hidden;
        }
        .pk-lb-img-wrap img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; filter: brightness(.9);
        }
        .pk-lb-img-wrap::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.85) 0%, transparent 40%);
        }
        .pk-lb-close {
            position: absolute; top: 16px; right: 16px; z-index: 10;
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(0,0,0,.6);
            border: 1px solid rgba(255,255,255,.15);
            color: #fff; font-size: 18px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: background .2s;
            backdrop-filter: blur(8px);
        }
        .pk-lb-close:hover { background: #ea580c; border-color: #ea580c; }
        .pk-lb-body { padding: 24px 28px 32px; }
        .pk-lb-title {
            font-family: 'Syne', sans-serif; font-weight: 800;
            font-size: clamp(18px, 3vw, 26px);
            color: #fff; line-height: 1.2; margin-bottom: 6px;
        }
        .pk-lb-divisi {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 3px 12px; border-radius: 999px;
            font-size: 10px; font-weight: 700;
            letter-spacing: .1em; text-transform: uppercase;
            background: rgba(234,88,12,.15);
            border: 1px solid rgba(234,88,12,.35);
            color: #fb923c; margin-bottom: 16px;
        }
        .pk-lb-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 10px; margin-bottom: 16px;
        }
        .pk-lb-stat {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 12px; padding: 12px 14px;
        }
        .pk-lb-stat-label {
            font-size: 10px; color: rgba(255,255,255,.3);
            text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px;
        }
        .pk-lb-stat-value { font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700; color: #fff; }
        .pk-lb-stat-value.accent { color: #fb923c; }
        .pk-lb-desc {
            font-size: 13.5px; color: rgba(255,255,255,.55);
            line-height: 1.75;
            border-left: 3px solid #ea580c;
            padding-left: 14px; margin-top: 4px;
        }

        @media (max-width: 639px) {
            .pk-lb-grid  { grid-template-columns: 1fr; }
            .pk-lb-body  { padding: 18px 18px 24px; }
        }

        /* ===== Custom scrollbar ===== */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #1c1917; }
        ::-webkit-scrollbar-thumb { background: #ea580c; border-radius: 4px; }

        /* ===== Reveal animation ===== */
        .reveal {
            opacity: 0; transform: translateY(32px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }
        .reveal-delay-5 { transition-delay: 0.5s; }

        .himadikti-reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .himadikti-reveal.visible { opacity: 1; transform: translateY(0); }
        .himadikti-reveal-d1 { transition-delay: 0.1s; }
        .himadikti-reveal-d2 { transition-delay: 0.2s; }
        .himadikti-reveal-d3 { transition-delay: 0.3s; }
        .himadikti-reveal-d4 { transition-delay: 0.4s; }

        .himadikti-slide-track {
            display: flex;
            transition: transform 0.55s cubic-bezier(0.77, 0, 0.18, 1);
        }

        .hero-title { font-size: clamp(32px, 6vw, 76px); }
        .section-title-dark, .section-title-light { font-size: clamp(26px, 3.5vw, 48px); }
        .about-title { font-size: clamp(24px, 3.5vw, 44px); }

        .carousel-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1.2s ease; }
        .carousel-slide.active { opacity: 1; }
        .carousel-slide::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(180deg, transparent 50%, rgba(234, 88, 12, 0.3) 100%);
        }
        .carousel-dot.active { width: 24px; border-radius: 4px; background: #ea580c; }

        #heroBg {
            position: absolute; inset: 0;
            background-image: url('images/pp.jpg');
            background-size: cover; background-position: center;
            transform: scale(1.05); transition: transform 8s ease;
        }
        #heroBg::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(10,10,10,0.75) 0%, rgba(0,0,0,0.6) 50%, rgba(10,10,10,0.7) 100%);
        }

        .scroll-line {
            width: 1px; height: 40px;
            background: linear-gradient(to bottom, rgba(255,255,255,0.5), transparent);
            animation: scrollDown 1.5s ease infinite;
        }

        .feature-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(234,88,12,0.08) 0%, transparent 60%);
            opacity: 0; transition: opacity 0.4s;
        }
        .feature-card:hover::before { opacity: 1; }

        .hero-tag-anim   { opacity: 0; animation: fadeUp 0.8s 0.3s forwards; }
        .hero-title-anim { opacity: 0; animation: fadeUp 0.8s 0.5s forwards; }
        .hero-sub-anim   { opacity: 0; animation: fadeUp 0.8s 0.7s forwards; }
        .hero-btns-anim  { opacity: 0; animation: fadeUp 0.8s 0.9s forwards; }
        .hero-scroll-anim{ opacity: 0; animation: fadeUp 0.8s 1.2s forwards; }

        #features::before {
            content: ''; position: absolute;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(234,88,12,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        #navbar.scrolled {
            background: rgba(10,10,10,0.75);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .nav-link { position: relative; }
        .nav-link::after {
            content: ''; position: absolute; bottom: -5px; left: 0;
            width: 0; height: 2px; background: #ea580c; transition: width 0.3s ease;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link.active { color: #ea580c !important; font-weight: 700; }

        .hero-typing { display: inline; }
        .typing-cursor {
            display: inline-block; width: 3px; background: #ea580c;
            margin-left: 2px; border-radius: 2px;
            animation: blink 0.75s step-end infinite;
            vertical-align: baseline; height: 0.85em;
            position: relative; top: 0.05em;
        }

        .typing-cursor-section {
            display: inline-block; width: 3px; height: 0.85em;
            background: #ea580c; margin-left: 4px; vertical-align: middle;
            animation: blink 0.75s step-end infinite;
        }
        .typing-cursor-section.hidden { display: none; }
        .section-title-type { min-height: 1.2em; display: inline-block; }
        .dynamic-underline { transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1); }

        .card-img-portrait { position: relative; width: 100%; padding-bottom: 110%; overflow: hidden; }
        .card-img-portrait img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; object-position: top center;
        }
        .card-img-portrait .gradient-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 55%);
        }
        .card-img-portrait .badge-overlay { position: absolute; top: 12px; right: 12px; }

        .card-inti {
            background: #ffffff; border: 1px solid #e5e7eb;
            border-radius: 1rem; overflow: hidden;
            transition: all 0.3s ease; box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }
        .card-inti:hover {
            transform: translateY(-6px); border-color: rgba(234,88,12,0.4);
            box-shadow: 0 20px 40px rgba(234,88,12,0.12);
        }
        .card-inti .card-body { padding: 1rem; background: #fff; }
        .card-inti .card-name { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.9rem; color: #111827; }
        .card-inti .card-role { color: #ea580c; font-size: 0.7rem; margin-top: 4px; font-weight: 600; }
        .card-inti .social-btn {
            width: 26px; height: 26px; border-radius: 50%;
            border: 1px solid rgba(234,88,12,0.35);
            display: flex; align-items: center; justify-content: center;
            font-size: 9px; font-weight: 700; color: #6b7280;
            text-decoration: none; transition: all 0.2s;
        }
        .card-inti .social-btn:hover { background: #ea580c; border-color: #ea580c; color: #fff; }
        .card-inti .badge-inti {
            background: rgba(234,88,12,0.12); border: 1px solid rgba(234,88,12,0.3);
            color: #ea580c; padding: 2px 8px; border-radius: 999px;
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
        }

        .card-divisi-img { position: relative; width: 100%; padding-bottom: 110%; overflow: hidden; }
        .card-divisi-img img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; object-position: top center;
        }

        #divisi { background: #ffffff; }
        .divisi-card {
            border: 1px solid #e5e7eb; border-radius: 1rem; overflow: hidden;
            transition: all 0.3s ease; background: #fff;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            cursor: pointer; position: relative;
        }
        .divisi-card:hover {
            border-color: rgba(234,88,12,0.5);
            box-shadow: 0 16px 40px rgba(234,88,12,0.15);
            transform: translateY(-4px);
        }
        .divisi-card img {
            width: 100%; height: 220px; object-fit: cover;
            transition: filter 0.35s ease; filter: brightness(0.85);
        }
        .divisi-card:hover img { filter: brightness(0.55); }
        .divisi-card .card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, transparent 55%);
        }
        .divisi-card .card-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 1.25rem; }
        .divisi-card .card-badge {
            position: absolute; top: 16px; left: 16px;
            padding: 3px 10px; border-radius: 999px;
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            background: rgba(234,88,12,0.2); border: 1px solid rgba(234,88,12,0.4); color: #ea580c;
        }
        .divisi-card h3 {
            font-family: 'Syne', sans-serif; font-weight: 800; color: #fff;
            font-size: clamp(14px, 2vw, 20px); line-height: 1.2; margin-bottom: 4px;
        }
        .divisi-card p { color: rgba(255,255,255,0.7); font-size: 0.8rem; margin-bottom: 12px; }
        .divisi-card .read-more-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 16px; border-radius: 999px;
            font-size: 12px; font-weight: 700;
            background: #ea580c; color: #fff;
            text-decoration: none; transition: all 0.3s;
        }
        .divisi-card .read-more-btn:hover {
            background: #c2410c;
            box-shadow: 0 8px 20px rgba(234,88,12,0.4);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .hero-title { font-size: clamp(28px, 9vw, 48px); }
            .section-title-dark, .section-title-light { font-size: clamp(22px, 6vw, 32px); }
            .about-title { font-size: clamp(20px, 6vw, 30px); }
        }
        /* ===== FEATURE CARDS NEW ===== */
.feat-card:hover {
    border-color: rgba(234,88,12,0.38) !important;
    transform: translateY(-7px);
    box-shadow: 0 24px 50px rgba(234,88,12,0.13), 0 0 0 1px rgba(234,88,12,0.12);
}
.feat-card:hover .feat-glow { opacity: 1; }
.feat-card:hover .feat-line  { opacity: 1; }
.feat-card:hover .feat-num   {
    color: rgba(234,88,12,0.09) !important;
    transform: scale(1.08);
}
.feat-card:hover .feat-icon  { transform: scale(1.12); }
    </style>
</head>

<body id="landing" class="font-sans text-black bg-white overflow-x-hidden">

    <!--{{-- ══ NAVBAR ══ --}}-->
    <nav id="navbar" class="fixed top-0 inset-x-0 z-[100] py-6 transition-all duration-500 bg-transparent">
        <div class="max-w-[1200px] mx-auto px-6 md:px-10 flex items-center justify-between">
            <a href="#home" class="flex items-center gap-3 group no-underline">
                <div class="relative">
                    <img src="{{ asset('images/himadikti.png') }}" alt="HIMADIKTI"
                        class="h-10 w-auto transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute -inset-1 bg-orange-600/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <span class="font-syne font-extrabold text-xl tracking-tight text-white group-hover:text-orange-500 transition-colors">HIMADIKTI</span>
            </a>

            <ul class="hidden lg:flex items-center gap-10 list-none">
                <li><a href="#home"     class="nav-link text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500">Beranda</a></li>
                <li><a href="#about"    class="nav-link text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500">Tentang</a></li>
                <li><a href="#features" class="nav-link text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500">Fitur</a></li>
                <li><a href="#divisi"   class="nav-link text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500">Divisi</a></li>
                <li><a href="#contact"  class="nav-link text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500">Kontak</a></li>
            </ul>

            <div class="flex items-center gap-5">
                <a href="/login"    class="hidden sm:block text-[0.85rem] font-bold text-white/80 no-underline hover:text-white transition-colors">Masuk</a>
                <a href="/register" class="px-6 py-2.5 bg-orange-600 text-white font-syne text-[0.8rem] font-bold no-underline rounded-full transition-all duration-300 hover:bg-orange-500 hover:shadow-[0_8px_20px_rgba(234,88,12,0.4)] hover:-translate-y-0.5 active:scale-95">Daftar</a>
            </div>
        </div>
    </nav>

    <!--{{-- ══ HERO ══ --}}-->
    <section id="hero" class="min-h-screen relative flex items-center justify-center overflow-hidden">
        <div id="heroBg"></div>
        <div class="relative z-[2] text-center text-white max-w-[800px] px-5 md:px-6">
            <div class="hero-tag-anim inline-flex items-center gap-2 px-3 py-1.5 bg-[rgba(255,255,255,0.3)] border border-[rgba(56,55,55,0.5)] rounded-full text-[10px] md:text-xs font-medium tracking-[2px] uppercase mb-6 md:mb-8 backdrop-blur-[10px]">
                <span class="w-1.5 h-1.5 bg-primary-600 rounded-full"></span>
                <span class="hidden sm:inline">Himpunan Mahasiswa Pendidikan Teknologi Informasi</span>
                <span class="sm:hidden">Himadikti</span>
            </div>

            <h2 class="hero-title font-extrabold leading-[1.05] tracking-[-1px] md:tracking-[-2px] mb-4 md:mb-6 hero-title-anim">
                <span id="heroLine1" class="hero-typing"></span><br>
                <span id="heroLine2Static">di </span><em id="heroLine2Typed" class="not-italic text-primary-600 hero-typing"></em><span class="typing-cursor" id="heroCursor"></span>
            </h2>

            <p class="text-sm md:text-lg font-light text-white/75 leading-[1.7] mb-8 md:mb-12 max-w-[520px] mx-auto hero-sub-anim">
                Wadah aspirasi, kreativitas, dan pengembangan diri untuk mahasiswa Pendidikan Teknologi Informasi
            </p>
            <div class="flex gap-3 md:gap-4 justify-center flex-wrap hero-btns-anim">
                <a href="/login" class="px-6 md:px-9 py-3 md:py-4 bg-orange-600 border-white/35 text-white text-sm md:text-[15px] font-bold no-underline rounded-[10px] transition-all duration-300 flex items-center gap-2 hover:bg-primary-400 hover:-translate-y-0.5 hover:shadow-[0_12px_30px_rgba(234,88,12,0.4)]">
                    Login Sekarang
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12"/></svg>
                </a>
                <a href="#about" class="px-6 md:px-9 py-3 md:py-4 bg-transparent text-white font-syne text-sm md:text-[15px] font-semibold no-underline rounded-[10px] border-2 border-white/35 transition-all duration-300 backdrop-blur-[10px] hover:border-white hover:bg-white/10">Pelajari Lebih</a>
            </div>
        </div>
        <div class="hero-scroll-anim absolute bottom-9 left-1/2 -translate-x-1/2 z-[2]">
            <a href="#about" class="flex flex-col items-center gap-1.5 no-underline text-white/50 text-[11px] tracking-[1.5px] uppercase">
                <div class="scroll-line"></div>
                <span>Scroll</span>
            </a>
        </div>
    </section>
<!--{{-- ══ FEATURES ══ --}}-->
<section id="features" class="py-20 md:py-[130px] bg-black relative overflow-hidden">

    <!--{{-- Background dekoratif --}}-->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div style="position:absolute;top:-120px;left:-120px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(234,88,12,0.13) 0%,transparent 70%);"></div>
        <div style="position:absolute;bottom:-150px;right:-80px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(234,88,12,0.09) 0%,transparent 70%);"></div>
        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.018) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.018) 1px,transparent 1px);background-size:56px 56px;"></div>
    </div>

    <div class="max-w-[1200px] mx-auto px-5 md:px-10 relative z-10">

        <!--{{-- ── Header ── --}}-->
        <div class="text-center mb-14 md:mb-20 reveal">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold tracking-[2.5px] uppercase mb-4"
                  style="background:rgba(234,88,12,0.12);border:1px solid rgba(234,88,12,0.3);color:#fb923c;">
                <span style="width:5px;height:5px;border-radius:50%;background:#ea580c;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                Fitur Platform
            </span>
            <h2 class="section-title-type section-title-dark font-syne font-extrabold text-white leading-[1.1] tracking-[-1px] md:tracking-[-1.5px] mb-1 block">
                <span class="type-part text-white" data-text="Fitur "></span><span class="type-part text-primary-500" data-text="Unggulan"></span><span class="typing-cursor-section"></span>
            </h2>
            <span class="dynamic-underline block h-[3px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-400 mx-auto mt-3 mb-5 transition-all duration-[800ms] ease-out"></span>
            <p class="text-sm md:text-[0.95rem] text-white/40 max-w-[420px] mx-auto leading-[1.75]">
                Platform lengkap untuk mendukung aktivitas dan keorganisasian mahasiswa
            </p>
        </div>

        <!--{{-- ── DESKTOP LAYOUT (hidden di mobile) ── --}}-->
        <div class="hidden md:grid md:grid-cols-3 gap-5">

            <!--{{-- Baris 1: Aspirasi | [FEATURED Pendaftaran] | Agenda --}}-->

            <!--{{-- Card 1 — Aspirasi --}}-->
            <div class="feat-card group relative rounded-2xl overflow-hidden reveal"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);transition:all .4s cubic-bezier(.23,1,.32,1);">
                <div class="feat-num absolute top-4 right-5 font-syne font-extrabold leading-none select-none pointer-events-none"
                     style="font-size:64px;color:rgba(255,255,255,0.03);transition:color .5s,transform .5s;">01</div>
                <div class="feat-glow absolute inset-0 opacity-0 transition-opacity duration-500 pointer-events-none"
                     style="background:linear-gradient(135deg,rgba(234,88,12,0.07) 0%,transparent 60%);"></div>
                <div class="feat-line absolute bottom-0 left-0 right-0 h-[2px] opacity-0 transition-opacity duration-500"
                     style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);"></div>
                <div class="relative z-10 p-7 flex flex-col h-full">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5 feat-icon transition-transform duration-300"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-[18px] h-[18px] text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <p class="text-[9px] font-bold tracking-[.18em] uppercase mb-2" style="color:rgba(234,88,12,.55);">Suara Mahasiswa</p>
                    <h3 class="font-syne font-extrabold text-white text-[17px] mb-3 leading-snug">Aspirasi Mahasiswa</h3>
                    <p class="text-[0.82rem] leading-[1.75] flex-1" style="color:rgba(255,255,255,0.38);">Sampaikan aspirasi dan ide untuk kemajuan bersama dengan mudah dan transparan.</p>
                    <div class="mt-5 pt-4 flex items-center gap-2" style="border-top:1px solid rgba(255,255,255,0.06);">
                        <span style="width:5px;height:5px;border-radius:50%;background:#ea580c;flex-shrink:0;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                        <span class="text-[10px] font-semibold" style="color:rgba(255,255,255,0.22);">Aktif & Realtime</span>
                    </div>
                </div>
            </div>

            <!--{{-- Card FEATURED — Pendaftaran Pengurus (TENGAH) --}}-->
            <div class="feat-card group relative rounded-2xl overflow-hidden reveal reveal-delay-1"
                 style="background:linear-gradient(145deg,rgba(234,88,12,0.22) 0%,#0d0d0d 55%);border:1px solid rgba(234,88,12,0.35);transition:all .4s cubic-bezier(.23,1,.32,1);transform:scale(1.03);">
                <div class="feat-num absolute top-4 right-5 font-syne font-extrabold leading-none select-none pointer-events-none"
                     style="font-size:64px;color:rgba(234,88,12,0.12);transition:color .5s,transform .5s;">04</div>
                <div class="absolute -bottom-8 -right-8 w-48 h-48 rounded-full pointer-events-none"
                     style="background:radial-gradient(circle,rgba(234,88,12,0.2) 0%,transparent 70%);"></div>
                <div class="feat-line absolute bottom-0 left-0 right-0 h-[2px]"
                     style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);opacity:1;"></div>
                <div class="relative z-10 p-7 flex flex-col h-full">
                    <div class="flex items-start justify-between mb-5">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center feat-icon transition-transform duration-300"
                             style="background:rgba(234,88,12,0.28);border:1px solid rgba(234,88,12,0.5);">
                            <svg class="w-[18px] h-[18px]" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span style="font-size:9px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;background:rgba(234,88,12,0.2);border:1px solid rgba(234,88,12,0.45);color:#fb923c;padding:3px 10px;border-radius:999px;">★ Unggulan</span>
                    </div>
                    <p class="text-[9px] font-bold tracking-[.18em] uppercase mb-2" style="color:rgba(234,88,12,.75);">Rekrutmen Terbuka</p>
                    <h3 class="font-syne font-extrabold text-white text-[17px] mb-3 leading-snug">Pendaftaran Pengurus</h3>
                    <p class="text-[0.82rem] leading-[1.75] flex-1" style="color:rgba(255,255,255,0.48);">Bergabung menjadi pengurus dan berkontribusi aktif dalam organisasi secara terbuka.</p>
                    <div class="mt-5 pt-4 flex items-center gap-2" style="border-top:1px solid rgba(234,88,12,0.18);">
                        <span style="width:5px;height:5px;border-radius:50%;background:#fb923c;flex-shrink:0;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                        <span class="text-[10px] font-semibold" style="color:rgba(234,88,12,0.65);">Proses Transparan</span>
                    </div>
                </div>
            </div>

            <!--{{-- Card 2 — Agenda --}}-->
            <div class="feat-card group relative rounded-2xl overflow-hidden reveal reveal-delay-2"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);transition:all .4s cubic-bezier(.23,1,.32,1);">
                <div class="feat-num absolute top-4 right-5 font-syne font-extrabold leading-none select-none pointer-events-none"
                     style="font-size:64px;color:rgba(255,255,255,0.03);transition:color .5s,transform .5s;">02</div>
                <div class="feat-glow absolute inset-0 opacity-0 transition-opacity duration-500 pointer-events-none"
                     style="background:linear-gradient(135deg,rgba(234,88,12,0.07) 0%,transparent 60%);"></div>
                <div class="feat-line absolute bottom-0 left-0 right-0 h-[2px] opacity-0 transition-opacity duration-500"
                     style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);"></div>
                <div class="relative z-10 p-7 flex flex-col h-full">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5 feat-icon transition-transform duration-300"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-[18px] h-[18px] text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[9px] font-bold tracking-[.18em] uppercase mb-2" style="color:rgba(234,88,12,.55);">Jadwal & Event</p>
                    <h3 class="font-syne font-extrabold text-white text-[17px] mb-3 leading-snug">Agenda Kegiatan</h3>
                    <p class="text-[0.82rem] leading-[1.75] flex-1" style="color:rgba(255,255,255,0.38);">Pantau dan ikuti berbagai kegiatan menarik yang diselenggarakan HIMA PTI.</p>
                    <div class="mt-5 pt-4 flex items-center gap-2" style="border-top:1px solid rgba(255,255,255,0.06);">
                        <span style="width:5px;height:5px;border-radius:50%;background:#ea580c;flex-shrink:0;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                        <span class="text-[10px] font-semibold" style="color:rgba(255,255,255,0.22);">Update Berkala</span>
                    </div>
                </div>
            </div>

            <!--{{-- Baris 2: Arsip | [FEATURED Program Kerja] | Rapat --}}-->

            <!--{{-- Card 3 — Arsip --}}-->
            <div class="feat-card group relative rounded-2xl overflow-hidden reveal reveal-delay-3"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);transition:all .4s cubic-bezier(.23,1,.32,1);">
                <div class="feat-num absolute top-4 right-5 font-syne font-extrabold leading-none select-none pointer-events-none"
                     style="font-size:64px;color:rgba(255,255,255,0.03);transition:color .5s,transform .5s;">03</div>
                <div class="feat-glow absolute inset-0 opacity-0 transition-opacity duration-500 pointer-events-none"
                     style="background:linear-gradient(135deg,rgba(234,88,12,0.07) 0%,transparent 60%);"></div>
                <div class="feat-line absolute bottom-0 left-0 right-0 h-[2px] opacity-0 transition-opacity duration-500"
                     style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);"></div>
                <div class="relative z-10 p-7 flex flex-col h-full">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5 feat-icon transition-transform duration-300"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-[18px] h-[18px] text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-[9px] font-bold tracking-[.18em] uppercase mb-2" style="color:rgba(234,88,12,.55);">Manajemen Berkas</p>
                    <h3 class="font-syne font-extrabold text-white text-[17px] mb-3 leading-snug">Arsip Dokumen</h3>
                    <p class="text-[0.82rem] leading-[1.75] flex-1" style="color:rgba(255,255,255,0.38);">Akses dokumen penting seperti surat, notulensi, dan arsip lainnya kapan saja.</p>
                    <div class="mt-5 pt-4 flex items-center gap-2" style="border-top:1px solid rgba(255,255,255,0.06);">
                        <span style="width:5px;height:5px;border-radius:50%;background:#ea580c;flex-shrink:0;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                        <span class="text-[10px] font-semibold" style="color:rgba(255,255,255,0.22);">Terorganisir Rapi</span>
                    </div>
                </div>
            </div>

            <!--{{-- Card FEATURED 2 — Program Kerja (TENGAH baris 2) --}}-->
            <div class="feat-card group relative rounded-2xl overflow-hidden reveal reveal-delay-4"
                 style="background:linear-gradient(145deg,rgba(234,88,12,0.22) 0%,#0d0d0d 55%);border:1px solid rgba(234,88,12,0.35);transition:all .4s cubic-bezier(.23,1,.32,1);transform:scale(1.03);">
                <div class="feat-num absolute top-4 right-5 font-syne font-extrabold leading-none select-none pointer-events-none"
                     style="font-size:64px;color:rgba(234,88,12,0.12);transition:color .5s,transform .5s;">05</div>
                <div class="absolute -bottom-8 -left-8 w-48 h-48 rounded-full pointer-events-none"
                     style="background:radial-gradient(circle,rgba(234,88,12,0.18) 0%,transparent 70%);"></div>
                <div class="feat-line absolute bottom-0 left-0 right-0 h-[2px]"
                     style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);opacity:1;"></div>
                <div class="relative z-10 p-7 flex flex-col h-full">
                    <div class="flex items-start justify-between mb-5">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center feat-icon transition-transform duration-300"
                             style="background:rgba(234,88,12,0.28);border:1px solid rgba(234,88,12,0.5);">
                            <svg class="w-[18px] h-[18px]" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <span style="font-size:9px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;background:rgba(234,88,12,0.2);border:1px solid rgba(234,88,12,0.45);color:#fb923c;padding:3px 10px;border-radius:999px;">★ Unggulan</span>
                    </div>
                    <p class="text-[9px] font-bold tracking-[.18em] uppercase mb-2" style="color:rgba(234,88,12,.75);">Monitoring & Evaluasi</p>
                    <h3 class="font-syne font-extrabold text-white text-[17px] mb-3 leading-snug">Program Kerja</h3>
                    <p class="text-[0.82rem] leading-[1.75] flex-1" style="color:rgba(255,255,255,0.48);">Monitoring dan evaluasi program kerja secara transparan, terukur, dan akuntabel.</p>
                    <div class="mt-5 pt-4 flex items-center gap-2" style="border-top:1px solid rgba(234,88,12,0.18);">
                        <span style="width:5px;height:5px;border-radius:50%;background:#fb923c;flex-shrink:0;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                        <span class="text-[10px] font-semibold" style="color:rgba(234,88,12,0.65);">Data Akuntabel</span>
                    </div>
                </div>
            </div>

            <!--{{-- Card 6 — Rapat --}}-->
            <div class="feat-card group relative rounded-2xl overflow-hidden reveal reveal-delay-5"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);transition:all .4s cubic-bezier(.23,1,.32,1);">
                <div class="feat-num absolute top-4 right-5 font-syne font-extrabold leading-none select-none pointer-events-none"
                     style="font-size:64px;color:rgba(255,255,255,0.03);transition:color .5s,transform .5s;">06</div>
                <div class="feat-glow absolute inset-0 opacity-0 transition-opacity duration-500 pointer-events-none"
                     style="background:linear-gradient(135deg,rgba(234,88,12,0.07) 0%,transparent 60%);"></div>
                <div class="feat-line absolute bottom-0 left-0 right-0 h-[2px] opacity-0 transition-opacity duration-500"
                     style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);"></div>
                <div class="relative z-10 p-7 flex flex-col h-full">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5 feat-icon transition-transform duration-300"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-[18px] h-[18px] text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <p class="text-[9px] font-bold tracking-[.18em] uppercase mb-2" style="color:rgba(234,88,12,.55);">Kolaborasi Tim</p>
                    <h3 class="font-syne font-extrabold text-white text-[17px] mb-3 leading-snug">Rapat & Notulensi</h3>
                    <p class="text-[0.82rem] leading-[1.75] flex-1" style="color:rgba(255,255,255,0.38);">Kelola jadwal rapat dan dokumentasi notulensi dengan rapi dan terorganisir.</p>
                    <div class="mt-5 pt-4 flex items-center gap-2" style="border-top:1px solid rgba(255,255,255,0.06);">
                        <span style="width:5px;height:5px;border-radius:50%;background:#ea580c;flex-shrink:0;display:inline-block;animation:pkPulse 2s ease-in-out infinite;"></span>
                        <span class="text-[10px] font-semibold" style="color:rgba(255,255,255,0.22);">Dokumentasi Lengkap</span>
                    </div>
                </div>
            </div>

        </div>

        <!--{{-- ── MOBILE LAYOUT 3×2 (hidden di desktop) ── --}}-->
        <div class="grid grid-cols-3 gap-3 md:hidden">

            <!--{{-- Mobile Card 1 — Aspirasi --}}-->
            <div class="relative rounded-xl overflow-hidden flex flex-col reveal"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);">
                <div class="relative z-10 p-3 flex flex-col h-full">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-3 flex-shrink-0"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <h3 class="font-syne font-extrabold text-white leading-tight mb-1" style="font-size:10px;">Aspirasi Mahasiswa</h3>
                    <p style="font-size:9px;color:rgba(255,255,255,0.35);line-height:1.5;">Sampaikan ide & aspirasi dengan mudah.</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-[1.5px]" style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);opacity:0.4;"></div>
            </div>

            <!--{{-- Mobile Card FEATURED — Pendaftaran (TENGAH baris 1) --}}-->
            <div class="relative rounded-xl overflow-hidden flex flex-col reveal reveal-delay-1"
                 style="background:linear-gradient(145deg,rgba(234,88,12,0.25) 0%,#0d0d0d 60%);border:1px solid rgba(234,88,12,0.4);">
                <div class="absolute top-2 right-2" style="font-size:7px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;background:rgba(234,88,12,0.25);border:1px solid rgba(234,88,12,0.5);color:#fb923c;padding:2px 6px;border-radius:999px;">★</div>
                <div class="relative z-10 p-3 flex flex-col h-full">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-3 flex-shrink-0"
                         style="background:rgba(234,88,12,0.3);border:1px solid rgba(234,88,12,0.55);">
                        <svg class="w-4 h-4" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="font-syne font-extrabold text-white leading-tight mb-1" style="font-size:10px;">Pendaftaran Pengurus</h3>
                    <p style="font-size:9px;color:rgba(255,255,255,0.45);line-height:1.5;">Bergabung & berkontribusi aktif.</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-[1.5px]" style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);"></div>
            </div>

            <!--{{-- Mobile Card 2 — Agenda --}}-->
            <div class="relative rounded-xl overflow-hidden flex flex-col reveal reveal-delay-2"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);">
                <div class="relative z-10 p-3 flex flex-col h-full">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-3 flex-shrink-0"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-syne font-extrabold text-white leading-tight mb-1" style="font-size:10px;">Agenda Kegiatan</h3>
                    <p style="font-size:9px;color:rgba(255,255,255,0.35);line-height:1.5;">Pantau kegiatan HIMA PTI.</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-[1.5px]" style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);opacity:0.4;"></div>
            </div>

            <!--{{-- Mobile Card 3 — Arsip --}}-->
            <div class="relative rounded-xl overflow-hidden flex flex-col reveal reveal-delay-3"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);">
                <div class="relative z-10 p-3 flex flex-col h-full">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-3 flex-shrink-0"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-syne font-extrabold text-white leading-tight mb-1" style="font-size:10px;">Arsip Dokumen</h3>
                    <p style="font-size:9px;color:rgba(255,255,255,0.35);line-height:1.5;">Akses dokumen kapan saja.</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-[1.5px]" style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);opacity:0.4;"></div>
            </div>

            <!--{{-- Mobile Card FEATURED 2 — Program Kerja (TENGAH baris 2) --}}-->
            <div class="relative rounded-xl overflow-hidden flex flex-col reveal reveal-delay-4"
                 style="background:linear-gradient(145deg,rgba(234,88,12,0.25) 0%,#0d0d0d 60%);border:1px solid rgba(234,88,12,0.4);">
                <div class="absolute top-2 right-2" style="font-size:7px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;background:rgba(234,88,12,0.25);border:1px solid rgba(234,88,12,0.5);color:#fb923c;padding:2px 6px;border-radius:999px;">★</div>
                <div class="relative z-10 p-3 flex flex-col h-full">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-3 flex-shrink-0"
                         style="background:rgba(234,88,12,0.3);border:1px solid rgba(234,88,12,0.55);">
                        <svg class="w-4 h-4" style="color:#fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h3 class="font-syne font-extrabold text-white leading-tight mb-1" style="font-size:10px;">Program Kerja</h3>
                    <p style="font-size:9px;color:rgba(255,255,255,0.45);line-height:1.5;">Monitoring & evaluasi terukur.</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-[1.5px]" style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);"></div>
            </div>

            <!--{{-- Mobile Card 6 — Rapat --}}-->
            <div class="relative rounded-xl overflow-hidden flex flex-col reveal reveal-delay-5"
                 style="background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);">
                <div class="relative z-10 p-3 flex flex-col h-full">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-3 flex-shrink-0"
                         style="background:rgba(234,88,12,0.15);border:1px solid rgba(234,88,12,0.22);">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <h3 class="font-syne font-extrabold text-white leading-tight mb-1" style="font-size:10px;">Rapat & Notulensi</h3>
                    <p style="font-size:9px;color:rgba(255,255,255,0.35);line-height:1.5;">Dokumentasi rapat lengkap.</p>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-[1.5px]" style="background:linear-gradient(90deg,transparent,#ea580c 50%,transparent);opacity:0.4;"></div>
            </div>

        </div>

        <!--{{-- ── Tagline bawah pengganti stats bar ── --}}-->
        <div class="mt-14 md:mt-16 reveal">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 px-6 md:px-10 py-6 rounded-2xl"
                 style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);">
                <div class="text-center sm:text-left">
                    <p class="font-syne font-extrabold text-white text-lg md:text-xl mb-1">Satu Platform, Semua Kebutuhan</p>
                    <p class="text-[0.8rem] text-white/30">Dari aspirasi hingga dokumentasi — semua ada di HIMADIKTI.</p>
                </div>
                <a href="/login"
                   class="flex-shrink-0 inline-flex items-center gap-2 px-6 py-3 rounded-full font-syne font-bold text-sm text-white no-underline transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_12px_28px_rgba(234,88,12,0.35)]"
                   style="background:#ea580c;">
                    Mulai Sekarang
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>
    <!--{{-- ══ ABOUT ══ --}}-->
<section id="about" class="py-16 md:py-[120px] bg-white">
    <div class="max-w-[1200px] mx-auto px-5 md:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-[80px] items-center">
            <!-- Bagian Carousel (Ganti src dengan path langsung) -->
            <div class="reveal">
                <div id="carousel" class="relative rounded-3xl overflow-hidden aspect-[4/5] md:aspect-square shadow-[0_30px_80px_rgba(0,0,0,0.15)] bg-gray-100">
                    
                    @php $aboutPhotos = \App\Models\LandingPhoto::section('about')->get(); @endphp
                    @forelse($aboutPhotos as $i => $ap)
                    <div class="carousel-slide {{ $i === 0 ? 'active' : '' }}">
                        <img src="{{ $ap->photo_url }}" alt="{{ $ap->title }}" class="w-full h-full object-cover">
                    </div>
                    @empty
                    <div class="carousel-slide active">
                        <img src="/images/pp.jpg" alt="HIMADIKTI" class="w-full h-full object-cover">
                    </div>
                    @endforelse

                    <div id="carouselDots" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-[3]"></div>
                </div>
            </div>

            <!-- Bagian Teks (Tidak Diubah) -->
            <div class="reveal reveal-delay-2 h-full flex flex-col justify-center">
                <p class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-primary-500 mb-2">Tentang Kami</p><br>
                <h2 class="section-title-type about-title font-syne font-extrabold leading-[1.1] tracking-[-1px] text-black mb-1 inline-block">
                    <span class="type-part text-black" data-text="Tentang "></span><em class="type-part not-italic text-primary-500" data-text="HIMADIKTI"></em><span class="typing-cursor-section"></span>
                </h2>
                <span class="dynamic-underline block h-[4px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mb-6 transition-all duration-[800ms] ease-out"></span>

                <div class="space-y-6 mt-2">
                    <div class="group relative pl-6 border-l-4 border-primary-600">
                        <h3 class="font-syne font-bold text-lg mb-2 flex items-center gap-2 text-black"><span class="text-primary-600">01.</span> Visi</h3>
                        <p class="text-gray-500 text-sm md:text-base leading-[1.8]">Menjadikan HIMADIKTI sebagai organisasi yang unggul dalam pengembangan IPTEK pendidikan, inovatif dalam berkarya, serta berlandaskan nilai kekeluargaan yang religius dan profesional.</p>
                    </div>
                    <div class="group relative pl-6 border-l-4 border-gray-200 hover:border-primary-600 transition-colors duration-300">
                        <h3 class="font-syne font-bold text-lg mb-3 flex items-center gap-2 text-black"><span class="text-primary-600">02.</span> Misi</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div class="mt-2.5 w-1.5 h-1.5 rounded-full bg-primary-600 shrink-0"></div>
                                <p class="text-gray-500 text-sm md:text-base leading-[1.7]">Menyelenggarakan pelatihan teknologi informasi yang relevan untuk meningkatkan kompetensi akademik.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-2.5 w-1.5 h-1.5 rounded-full bg-primary-600 shrink-0"></div>
                                <p class="text-gray-500 text-sm md:text-base leading-[1.7]">Mengoptimalkan wadah aspirasi dan advokasi yang solutif bagi seluruh mahasiswa PTI.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-2.5 w-1.5 h-1.5 rounded-full bg-primary-600 shrink-0"></div>
                                <p class="text-gray-500 text-sm md:text-base leading-[1.7]">Membangun kolaborasi strategis dengan pihak internal maupun eksternal.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="h-px w-full bg-[linear-gradient(90deg,transparent,#ea580c,transparent)]"></div>

    <!--{{-- ══ PROKER TEREALISASI (VERSI BARU) ══ --}}-->
    @php
        $prokerSelesai = \App\Models\Proker::where('status', 'selesai')
            ->with(['pembuat', 'monitoring'])
            ->latest('updated_at')
            ->get();

        $totalSelesai  = $prokerSelesai->count();
        $divisiAktif   = $prokerSelesai->pluck('divisi')->filter()->unique()->count();
        $totalPartAll  = \App\Models\MonitoringProker::whereIn('proker_id', $prokerSelesai->pluck('id'))->sum('partisipasi_anggota');
        $divisiList    = $prokerSelesai->pluck('divisi')->filter()->unique()->sort()->values();
    @endphp

    <section id="proker-selesai" class="py-16 md:py-[100px] bg-black relative overflow-hidden">

        <!--{{-- Decorative blobs --}}-->
        <div class="absolute pointer-events-none blur-[100px] rounded-full w-[600px] h-[600px] bg-orange-700/[.08] -top-32 -right-40"></div>
        <div class="absolute pointer-events-none blur-[80px]  rounded-full w-[400px] h-[400px] bg-orange-900/[.12] bottom-0 left-0"></div>
        <div class="absolute pointer-events-none blur-[60px]  rounded-full w-[300px] h-[300px] bg-orange-600/[.06] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

        <div class="max-w-[1240px] mx-auto px-5 md:px-10 relative z-10">

            <!--{{-- Header --}}-->
            <div class="text-center mb-12 md:mb-16 reveal">
             <p class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-primary-600 mb-2">
                Galeri Keberhasilan
            </p><br>
          
                <p class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-primary-600 mb-2">Galeri Keberhasilan</p><br>
                <h2 class="section-title-type section-title-dark font-syne font-extrabold text-white tracking-[-1px] leading-[1.1] mb-1 inline-block">
                    <span class="type-part text-white"   data-text="Proker "></span><span
                          class="type-part text-primary-500" data-text="Terealisasi"></span><span
                          class="typing-cursor-section"></span>
                </h2>
                <span class="dynamic-underline block h-[4px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-2 mb-4 transition-all duration-[800ms] ease-out"></span>
                <p class="text-sm md:text-base text-white/40 max-w-[500px] mx-auto leading-[1.6]">
                   Galeri prestasi program kerja yang telah terealisasi:  <em class="not-italic text-orange-500 font-semibold">lihat detail pelaksanaan,</em> metrik sukses, dan testimoni untuk inspirasi dan akuntabilitas publik.
                </p>
            </div>

            @if($prokerSelesai->isEmpty())

                <!--{{-- Empty State --}}-->
                <div class="pk-empty reveal">
                    <svg class="mx-auto w-14 h-14 mb-5 opacity-25" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-semibold mb-1">Belum ada program kerja terealisasi</p>
                    <p class="text-xs opacity-60">Data akan muncul otomatis setelah admin mengubah status proker menjadi <strong>terealisasikan</strong></p>
                </div>

            @else

                <!--{{-- Stats Counter --}}-->
                <!--<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-12 reveal" id="pk-stats">-->
                <!--    <div class="relative bg-white/[.03] border border-white/[.06] rounded-2xl p-5 md:p-6 text-center overflow-hidden group hover:border-orange-600/30 hover:bg-white/[.05] transition-all duration-300 cursor-default">-->
                <!--        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>-->
                <!--        <span class="pk-counter-val" data-target="{{ $totalSelesai }}">0</span>-->
                <!--        <p class="text-[10px] text-white/30 uppercase tracking-widest mt-1">Program Kerja</p>-->
                <!--    </div>-->
                <!--    <div class="relative bg-white/[.03] border border-white/[.06] rounded-2xl p-5 md:p-6 text-center overflow-hidden group hover:border-orange-600/30 hover:bg-white/[.05] transition-all duration-300 cursor-default">-->
                <!--        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>-->
                <!--        <span class="pk-counter-val accent" data-target="{{ $divisiAktif }}">0</span>-->
                <!--        <p class="text-[10px] text-white/30 uppercase tracking-widest mt-1">Divisi Terlibat</p>-->
                <!--    </div>-->
                <!--    <div class="relative bg-white/[.03] border border-white/[.06] rounded-2xl p-5 md:p-6 text-center overflow-hidden group hover:border-orange-600/30 hover:bg-white/[.05] transition-all duration-300 cursor-default">-->
                <!--        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>-->
                <!--        @if($totalPartAll > 0)-->
                <!--            <span class="pk-counter-val" data-target="{{ $totalPartAll }}">0</span>-->
                <!--        @else-->
                <!--            <span class="pk-counter-val" style="font-size:28px">—</span>-->
                <!--        @endif-->
                <!--        <p class="text-[10px] text-white/30 uppercase tracking-widest mt-1">Total Partisipan</p>-->
                <!--    </div>-->
                <!--    <div class="relative bg-white/[.03] border border-white/[.06] rounded-2xl p-5 md:p-6 text-center overflow-hidden group hover:border-orange-600/30 hover:bg-white/[.05] transition-all duration-300 cursor-default">-->
                <!--        <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>-->
                <!--        <span class="pk-counter-val accent">100<span style="font-size:.55em;font-weight:700">%</span></span>-->
                <!--        <p class="text-[10px] text-white/30 uppercase tracking-widest mt-1">Tingkat Realisasi</p>-->
                <!--    </div>-->
                <!--</div>-->

                <!--{{-- Filter Pills --}}-->
                @if($divisiList->count() > 1)
               <div class="pk-filters-wrap mb-8 reveal">
    <div class="flex gap-2 w-max mx-auto">
        <button class="pk-filter-btn pk-active" data-filter="semua">Semua</button>
        @foreach($divisiList as $div)
            <button class="pk-filter-btn" data-filter="{{ Str::slug($div) }}">{{ $div }}</button>
        @endforeach
    </div>
</div>
                @endif

                <!--{{-- Card Grid --}}-->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6" id="pk-grid">

                    @foreach($prokerSelesai as $idx => $pk)
                        @php
                             $fotoUrl     = $pk->foto_dokumentasi ? asset('storage/' . $pk->foto_dokumentasi) : null;
                            $divisiSlug  = Str::slug($pk->divisi ?? '');
                            $totalPartPk = $pk->monitoring ? $pk->monitoring->sum('partisipasi_anggota') : 0;
                            $tglSelesai  = $pk->tanggal_selesai
                                ? \Carbon\Carbon::parse($pk->tanggal_selesai)->locale('id')->isoFormat('MMM YYYY')
                                : '—';
                            $anggaranFmt = $pk->anggaran
                                ? 'Rp ' . number_format($pk->anggaran, 0, ',', '.')
                                : null;
                            $isHidden    = $idx >= 9;
                        @endphp

                        <div class="pk-card reveal {{ $isHidden ? 'pk-hidden pk-loadmore-item' : '' }}"
                             data-divisi="{{ $divisiSlug }}"
                             onclick="pkOpenLightbox({
                                 title:      '{{ addslashes($pk->nama_proker) }}',
                                 divisi:     '{{ addslashes($pk->divisi ?? '') }}',
                                 ketua:      '{{ addslashes($pk->ketua_pelaksana ?? '') }}',
                                 desc:       '{{ addslashes(Str::limit($pk->deskripsi ?? '', 300)) }}',
                                 tgl:        '{{ $tglSelesai }}',
                                 partisipan: {{ $totalPartPk }},
                                 anggaran:   '{{ $anggaranFmt ?? '' }}',
                                 foto:       '{{ $fotoUrl ?? '' }}'
                             })">

                            <!--{{-- Image --}}-->
                            <div class="pk-img-wrap">
                                @if($fotoUrl)
                                   <img src="{{ $fotoUrl }}?v={{ time() }}" alt="{{ $pk->nama_proker }}" loading="lazy">
    @else
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:#181818;">
            <svg width="48" height="48" fill="none" stroke="rgba(255,255,255,.12)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    @endif
    
    @if($pk->divisi)
        <span class="pk-badge-divisi">{{ $pk->divisi }}</span>
    @endif
    <span class="pk-badge-selesai">Selesai</span>

                                <!--{{-- Progress Ring 100% --}}-->
                                <div style="position:absolute;bottom:12px;right:12px;z-index:2;">
                                    <svg width="44" height="44" viewBox="0 0 36 36" class="pk-ring">
                                        <circle class="pk-ring-track" cx="18" cy="18" r="15" stroke-width="2.5"/>
                                        <circle class="pk-ring-fill"  cx="18" cy="18" r="15" stroke-width="2.5"/>
                                        <text x="18" y="21.5" text-anchor="middle"
                                              style="fill:#ffffff;font-size:8px;font-weight:800;font-family:Syne,-apple-system,sans-serif;"
                                              transform="rotate(90,18,18)">100%</text>
                                    </svg>
                                </div>
                            </div>

                            <!--{{-- Body --}}-->
                            <div class="pk-body" style="position:relative;z-index:1;">
                                <h3 class="pk-title">{{ $pk->nama_proker }}</h3>

                                @if($pk->ketua_pelaksana)
                                    <p class="pk-ketua">Ketua: <span>{{ $pk->ketua_pelaksana }}</span></p>
                                @endif

                                @if($pk->deskripsi)
                                    <p class="pk-desc">{{ $pk->deskripsi }}</p>
                                @endif

                                <div class="pk-footer">
                                    <div style="display:flex;align-items:center;gap:12px;">
                                        <span class="pk-meta">
                                            <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $tglSelesai }}
                                        </span>
                                        @if($totalPartPk > 0)
                                            <span class="pk-meta">
                                                <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $totalPartPk }}
                                            </span>
                                        @endif
                                    </div>
                                    <span style="font-size:10px;color:rgba(234,88,12,.7);font-weight:700;display:flex;align-items:center;gap:3px;">
                                        Detail
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!--{{-- Load More --}}-->
                @if($prokerSelesai->count() > 9)
                <div class="flex justify-center mt-10 reveal">
                    <button class="pk-load-more" id="pk-load-more-btn" onclick="pkLoadMore()">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tampilkan Lebih Banyak
                        <span id="pk-remaining" style="background:rgba(234,88,12,.2);border:1px solid rgba(234,88,12,.4);color:#fb923c;border-radius:999px;padding:1px 8px;font-size:10px;">
                            {{ $prokerSelesai->count() - 9 }} lagi
                        </span>
                    </button>
                </div>
                @endif

                <!--{{-- Ticker Divisi --}}-->
                @if($divisiList->count() > 0)
                <div class="mt-14 overflow-hidden opacity-20 select-none" aria-hidden="true">
                    <div style="display:inline-flex;align-items:center;gap:12px;white-space:nowrap;animation:marqueeProker 22s linear infinite;">
                        @for($r = 0; $r < 3; $r++)
                            @foreach($divisiList as $div)
                                <span style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.25em;color:#fff;">{{ $div }}</span>
                                <span style="color:#ea580c;font-size:10px;">✦</span>
                            @endforeach
                        @endfor
                    </div>
                </div>
                @endif

            @endif
        </div>
    </section>

    <!--{{-- Lightbox Modal --}}-->
    <div id="pk-lightbox" role="dialog" aria-modal="true" aria-label="Detail Program Kerja" onclick="pkCloseLightboxOutside(event)">
        <div class="pk-lb-inner" id="pk-lb-inner">
            <div class="pk-lb-img-wrap" id="pk-lb-img-wrap">
                <img src="" alt="" id="pk-lb-img">
                <button class="pk-lb-close" onclick="pkCloseLightbox()" aria-label="Tutup">&times;</button>
            </div>
            <div class="pk-lb-body">
                <h2 class="pk-lb-title" id="pk-lb-title"></h2>
                <span class="pk-lb-divisi" id="pk-lb-divisi"></span>
                <div class="pk-lb-grid">
                    <div class="pk-lb-stat">
                        <p class="pk-lb-stat-label">Ketua Pelaksana</p>
                        <p class="pk-lb-stat-value" id="pk-lb-ketua">—</p>
                    </div>
                    <div class="pk-lb-stat">
                        <p class="pk-lb-stat-label">Selesai</p>
                        <p class="pk-lb-stat-value accent" id="pk-lb-tgl">—</p>
                    </div>
                    <div class="pk-lb-stat" id="pk-lb-stat-part">
                        <p class="pk-lb-stat-label">Total Partisipan</p>
                        <p class="pk-lb-stat-value" id="pk-lb-part">—</p>
                    </div>
                    <div class="pk-lb-stat" id="pk-lb-stat-ang">
                        <p class="pk-lb-stat-label">Anggaran</p>
                        <p class="pk-lb-stat-value accent" id="pk-lb-ang">—</p>
                    </div>
                </div>
                <p class="pk-lb-desc" id="pk-lb-desc"></p>
            </div>
        </div>
    </div>

    <div class="h-px w-full bg-[linear-gradient(90deg,transparent,#ea580c,transparent)]"></div>

    <!--{{-- ══ PENGURUS INTI ══ --}}-->
    <section id="team" class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5 md:px-6">
            <div class="text-center mb-12 md:mb-16 himadikti-reveal">
                <span class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-primary-500 mb-3">Kepengurusan</span><br>
                <h2 class="section-title-type font-syne font-extrabold text-black tracking-tight leading-tight text-2xl md:text-4xl inline-block">
                    <span class="type-part text-black" data-text="Badan Pengurus "></span><span class="type-part text-primary-500" data-text="Inti"></span><span class="typing-cursor-section"></span>
                </h2>
                <span class="dynamic-underline block h-[4px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-2 mb-4 transition-all duration-[800ms] ease-out"></span>
                <p class="text-black/40 text-xs md:text-sm mt-3 max-w-sm mx-auto">Pimpinan utama yang menjalankan roda organisasi HIMADIKTI.</p>
            </div>

            <div class="relative" id="slider-inti">
                <div class="overflow-hidden rounded-2xl">
                    <div class="himadikti-slide-track" id="track-inti">
                        @php $teamInti = \App\Models\LandingPhoto::section('team_inti')->get(); @endphp
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
                    </div>
                </div>
                <button onclick="slide('inti',-1)" class="absolute -left-3 md:-left-5 top-1/2 -translate-y-1/2 z-10 w-9 h-9 md:w-10 md:h-10 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center shadow-lg hover:bg-primary-500 hover:scale-110 transition-all">‹</button>
                <button onclick="slide('inti', 1)" class="absolute -right-3 md:-right-5 top-1/2 -translate-y-1/2 z-10 w-9 h-9 md:w-10 md:h-10 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center shadow-lg hover:bg-primary-500 hover:scale-110 transition-all">›</button>
                <div class="flex justify-center gap-2 mt-6" id="dots-inti"></div>
            </div>
        </div>
    </section>

    <!--{{-- ══ KETUA DIVISI ══ --}}-->
    <section class="pb-16 md:pb-24 bg-black">
        <div class="max-w-7xl mx-auto px-5 md:px-6">
            <div class="h-px mb-12 md:mb-16 w-full opacity-20 bg-primary-600"></div>
            <div class="text-center mb-12 md:mb-16 himadikti-reveal">
                <span class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-primary-500 mb-3">Kepemimpinan Divisi</span><br>
                <h2 class="section-title-type font-syne font-extrabold text-white tracking-tight leading-tight text-2xl md:text-4xl inline-block">
                    <span class="type-part text-white" data-text="Ketua "></span><span class="type-part text-primary-500" data-text="Divisi"></span><span class="typing-cursor-section"></span>
                </h2>
                <span class="dynamic-underline block h-[4px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-2 mb-4 transition-all duration-[800ms] ease-out"></span>
                <p class="text-white/40 text-xs md:text-sm mt-3 max-w-sm mx-auto">Para pemimpin yang menggerakkan setiap divisi dengan penuh dedikasi.</p>
            </div>

            <div class="relative" id="slider-internal">
                <div class="overflow-hidden rounded-2xl">
                    <div class="himadikti-slide-track" id="track-internal">
                        @php
                            $ketua_divisi = \App\Models\LandingPhoto::section('team_divisi')->get()->map(function($m) {
                                return ['name' => $m->title, 'role' => $m->subtitle, 'img' => $m->photo_url];
                            });
                        @endphp
                        @foreach ($ketua_divisi as $m)
                            <div class="shrink-0 w-[calc(100%-16px)] md:w-[calc(50%-16px)] lg:w-[calc(33.333%-16px)] mx-2">
                                <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:border-primary-600/40 hover:shadow-[0_20px_40px_rgba(234,88,12,0.15)]">
                                    <div class="card-divisi-img">
                                        <img src="{{ $m['img'] }}" alt="{{ $m['name'] }}" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                        <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-primary-800/60 border border-primary-700/40 text-primary-300">Divisi</span>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-syne font-bold text-sm md:text-base text-white">{{ $m['name'] }}</h3>
                                        <p class="text-primary-400 text-xs mt-1 font-medium">{{ $m['role'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button onclick="slide('internal',-1)" class="absolute -left-3 md:-left-5 top-1/2 -translate-y-1/2 z-10 w-9 h-9 md:w-10 md:h-10 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center shadow-lg hover:bg-primary-500 hover:scale-110 transition-all">‹</button>
                <button onclick="slide('internal', 1)" class="absolute -right-3 md:-right-5 top-1/2 -translate-y-1/2 z-10 w-9 h-9 md:w-10 md:h-10 rounded-full bg-primary-600 text-white font-bold flex items-center justify-center shadow-lg hover:bg-primary-500 hover:scale-110 transition-all">›</button>
                <div class="flex justify-center gap-2 mt-6" id="dots-internal"></div>
            </div>
        </div>
    </section>

    <div class="h-px w-full opacity-30 bg-[linear-gradient(90deg,transparent,#ea580c,transparent)]"></div>

    <!--{{-- ══ DIVISI CARDS ══ --}}-->
    <section id="divisi" class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5 md:px-6">
            <div class="text-center mb-12 md:mb-16 himadikti-reveal">
                <span class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-primary-500 mb-3">Unit Kerja</span><br>
                <h2 class="section-title-type font-syne font-extrabold text-gray-900 tracking-tight leading-tight text-2xl md:text-4xl inline-block">
                    <span class="type-part text-gray-900" data-text="Divisi "></span><span class="type-part text-primary-500" data-text="Kami"></span><span class="typing-cursor-section"></span>
                </h2>
                <span class="dynamic-underline block h-[4px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-2 mb-4 transition-all duration-[800ms] ease-out"></span>
                <p class="text-gray-500 text-xs md:text-sm mt-3 max-w-sm mx-auto">Klik <em class="not-italic font-semibold text-primary-600">Read More</em> untuk mengenal lebih dalam setiap divisi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                @php
                    $divisi = \App\Models\LandingPhoto::section('divisi')->get()->map(function($m) {
                        return ['name' => $m->title, 'slug' => $m->link, 'img' => $m->photo_url, 'desc' => $m->description];
                    });
                @endphp
                @foreach ($divisi as $idx => $d)
                    @php $delay = ['','himadikti-reveal-d1','himadikti-reveal-d2','himadikti-reveal-d3'][$idx % 4]; @endphp
                    <div class="divisi-card himadikti-reveal {{ $delay }}">
                        <img src="{{ $d['img'] }}" alt="{{ $d['name'] }}" />
                        <div class="card-overlay"></div>
                        <div class="card-badge bg-slate-400">Unit Kerja</div>
                        <div class="card-content">
                            <h3>{{ strtoupper($d['name']) }}</h3>
                            <p>{{ $d['desc'] }}</p>
                            <a href="{{ route('divisi.show', ['slug' => $d['slug']]) }}" class="read-more-btn">
                                Read More
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!--{{-- ══ PRESTASI ══ --}}-->
   <section id="prestasi" class="md:py-[120px] bg-black relative">
    <div class="max-w-[1200px] mx-auto px-5 md:px-10">
        
        <!-- Header Section -->
       <div class="text-center max-w-3xl mx-auto mb-10 md:mb-14 reveal">
            <span class="inline-block text-[10px] md:text-[11px] font-bold tracking-[3px] uppercase text-orange-500 mb-4">Apresiasi & Kebanggaan</span><br>
        
            <h2 class="section-title-type font-syne font-extrabold leading-[1.1] tracking-[-1px] text-3xl md:text-5xl mb-1 inline-block text-white">
                <span class="type-part text-white" data-text="Congratulations!">Congratulations!</span><span class="typing-cursor-section"></span>
            </h2>
            
            <span class="dynamic-underline block h-[4px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-2 mb-6 transition-all duration-[800ms] ease-out"></span>
            
            <p class="text-sm md:text-base leading-[1.8] text-gray-400">
                Mahasiswa <em class="not-italic text-orange-400"> PTI Berprestasi </em> yang telah mengharumkan nama program studi dan universitas di berbagai ajang kompetisi bergengsi.
            </p>
        </div>

        <!-- Carousel Section -->
        <div class="reveal reveal-delay-2 max-w-md mx-auto relative group">
            <div id="prestasi-carousel" class="relative rounded-3xl overflow-hidden aspect-[2/2] shadow-[0_30px_80px_rgba(29,2,45,2.15)] bg-gray-900 border border-gray-800">
                
                <!-- Pastikan file gambar benar-benar ada di public/images/prestasi/ -->
                @php $prestasiPhotos = \App\Models\LandingPhoto::section('prestasi')->get(); @endphp
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

</section>
<div class="py-8 bg-[#050505]">
    <div class="h-px w-full bg-[linear-gradient(90deg,transparent,#ea580c,transparent)]"></div>
</div>

  <footer id="contact" class="bg-[#050505] border-t border-white/5 relative z-10">
    <div class="max-w-[1200px] mx-auto pt-16 pb-8 px-6 md:px-10">

        <!--{{-- Brand & Deskripsi — full width di mobile --}}-->
        <div class="mb-8">
            <div class="flex items-center gap-2.5 mb-3.5">
                <img src="{{ asset('images/himadikti.png') }}" alt="HIMADIKTI" class="h-9 w-auto">
                <span class="font-syne font-extrabold text-2xl text-orange-600">HIMADIKTI</span>
            </div>
            <p class="text-[.84rem] leading-[1.75] text-white/40 text-justify w-full md:max-w-[280px]">
                Himpunan Mahasiswa Pendidikan Teknologi Informasi — wadah aspirasi, kreativitas, dan pengembangan diri mahasiswa PTI.
            </p>
        </div>

        <div class="h-px w-full mb-8" style="background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent);"></div>

        {{-- Grid: 2x2 di mobile, 4 kolom 1 baris di desktop --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-8 md:gap-x-10 pb-12 border-b border-white/5">

            <!--{{-- Kolom 1: Navigasi --}}-->
            <div>
                <p class="font-syne text-[.75rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4">Navigasi</p>
                <div class="flex flex-col gap-2.5">
                    <a href="#home"     class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Beranda</a>
                    <a href="#about"    class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Tentang Kami</a>
                    <a href="#features" class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Fitur Platform</a>
                    <a href="#team"     class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Pengurus</a>
                    <a href="#contact"  class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Kontak</a>
                </div>
            </div>

            <!--{{-- Kolom 2: Divisi --}}-->
            <div>
                <p class="font-syne text-[.75rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4">Divisi</p>
                <div class="flex flex-col gap-2.5">
                    <a href="{{ route('divisi.show', 'divisi-kesekretariatan') }}" class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Kesekretariatan</a>
                    <a href="{{ route('divisi.show', 'divisi-it') }}"              class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">IT</a>
                    <a href="{{ route('divisi.show', 'divisi-psdm') }}"            class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">PSDM</a>
                    <a href="{{ route('divisi.show', 'divisi-advokasi') }}"        class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Advokasi</a>
                    <a href="{{ route('divisi.show', 'divisi-dana-usaha') }}"      class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Dana Usaha</a>
                    <a href="{{ route('divisi.show', 'divisi-sosial-budaya') }}"   class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Sosial Budaya</a>
                </div>
            </div>

            <!--{{-- Kolom 3: Platform --}}-->
            <div>
                <p class="font-syne text-[.75rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4">Platform</p>
                <div class="flex flex-col gap-2.5">
                    <a href="/login"            class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Login / Masuk</a>
                    <a href="/register"         class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Daftar Akun</a>
                    <a href="#features"         class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Aspirasi</a>
                    <a href="#proker-selesai"   class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Program Kerja</a>
                    <a href="#features"         class="text-[.78rem] text-white/40 no-underline hover:text-orange-500 transition-colors leading-snug">Agenda</a>
                </div>
            </div>

            <!--{{-- Kolom 4: Kontak --}}-->
            <div>
                <p class="font-syne text-[.75rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4">Kontak</p>
                <div class="flex flex-col gap-3">
                    <p class="text-[.78rem] text-white/70 leading-snug">✉ himadiktiipi@gmail.com</p>
                    <p class="text-[.78rem] text-white/70 leading-snug">☎ +62 831-3456-7890</p>
                    <p class="text-[.78rem] text-white/70 leading-snug">📍 Kampus IPI, Gedung Skema Lt. 2</p>
                </div>
            </div>

        </div>
<div class="flex flex-col items-center gap-1.5 pt-7 text-center">
    <p class="text-[.78rem] text-white/25">© 2025 HIMADIKTI — Himpunan Mahasiswa Pendidikan Teknologi Informasi.</p>
    <p class="text-[.78rem] text-white/20 italic">Bersama membangun generasi digital yang berkarakter.</p>

    <!--{{-- Developer Credit --}}-->
    <div class="flex items-center justify-center gap-1.5 flex-wrap mt-1">
        <span class="text-[10px] text-white/10">Developed by</span>
        <span class="w-[3px] h-[3px] rounded-full bg-white/[.08] inline-block"></span>

        <span class="relative group cursor-default">
            <span class="text-[10px] font-semibold text-orange-600/30 group-hover:text-orange-500/65 transition-colors duration-200">
              DexS-Asep Misbah · 22833014
            </span>
            <!--{{-- Tooltip --}}-->
            <div class="absolute bottom-[calc(100%+9px)] left-1/2 -translate-x-1/2
                        hidden group-hover:block z-50
                        bg-[#111] border border-orange-600/20 rounded-xl px-4 py-3
                        shadow-[0_8px_24px_rgba(0,0,0,0.6)] whitespace-nowrap text-left">
                <p class="text-[11px] text-white/45 mb-1.5 leading-relaxed">👨‍💻 <span class="text-white/75 font-semibold">Asep Misbah</span></p>
                <p class="text-[11px] text-white/45 mb-1.5 leading-relaxed">🎓 <span class="text-white/75 font-semibold">22833014</span></p>
                <p class="text-[11px] text-white/45 mb-1.5 leading-relaxed">✉ <span class="text-white/75 font-semibold">asepmisbb@gmail.com</span></p>
                <p class="text-[11px] text-white/45 leading-relaxed">📱 <span class="text-white/75 font-semibold">083191840343</span></p>
                <div class="absolute -bottom-[5px] left-1/2 -translate-x-1/2 rotate-45 w-2 h-2
                            bg-[#111] border-r border-b border-orange-600/20"></div>
            </div>
        </span>

        <span class="w-[3px] h-[3px] rounded-full bg-white/[.08] inline-block"></span>
        <span class="text-[10px] text-white/10">PTI IPI 2025</span>
    </div>
</div>

    </div>
</footer>

    <script>
    // ===== NAVBAR =====
    document.addEventListener('DOMContentLoaded', function () {
        const navbar   = document.getElementById('navbar');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');

            let current = "";
            document.querySelectorAll('section[id]').forEach(section => {
                if (pageYOffset >= section.offsetTop - 100) current = section.getAttribute('id');
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) link.classList.add('active');
            });
        }, { passive: true });
    });

    // ===== HERO PARALLAX =====
    const heroBg = document.getElementById('heroBg');
    window.addEventListener('scroll', () => {
        const scale = 1.05 + window.scrollY * 0.00008;
        heroBg.style.transform = `scale(${Math.min(scale, 1.12)})`;
    });

    // ===== CAROUSEL ABOUT =====
    const slides        = document.querySelectorAll('.carousel-slide');
    const dotsContainer = document.getElementById('carouselDots');
    let currentSlide    = 0;

    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'carousel-dot w-2 h-2 rounded-full bg-white/50 cursor-pointer transition-all duration-300 border-0' + (i === 0 ? ' active' : '');
        dot.addEventListener('click', () => {
            slides[currentSlide].classList.remove('active');
            dotsContainer.children[currentSlide].classList.remove('active');
            currentSlide = i;
            slides[currentSlide].classList.add('active');
            dotsContainer.children[currentSlide].classList.add('active');
        });
        dotsContainer.appendChild(dot);
    });
    setInterval(() => {
        slides[currentSlide].classList.remove('active');
        dotsContainer.children[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
        dotsContainer.children[currentSlide].classList.add('active');
    }, 3500);

    // ===== SCROLL REVEAL =====
    const revealObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    const himadiktiObserver = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.himadikti-reveal').forEach(el => himadiktiObserver.observe(el));

    // ===== TYPING TITLE (section headings) =====
    const typeObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('typed-done')) {
                entry.target.classList.add('typed-done');
                const parts    = entry.target.querySelectorAll('.type-part');
                const cursor   = entry.target.querySelector('.typing-cursor-section');
                const underline= entry.target.nextElementSibling;
                let currentPart= 0;

                function typeNextPart() {
                    if (currentPart < parts.length) {
                        const part = parts[currentPart];
                        const text = part.getAttribute('data-text');
                        let charIndex = 0;
                        (function typeChar() {
                            if (charIndex < text.length) {
                                part.textContent += text[charIndex++];
                                setTimeout(typeChar, 50);
                            } else { currentPart++; typeNextPart(); }
                        })();
                    } else {
                        if (cursor) cursor.classList.add('hidden');
                        if (underline && underline.classList.contains('dynamic-underline')) {
                            underline.style.width = entry.target.offsetWidth + 'px';
                        }
                    }
                }
                setTimeout(typeNextPart, 300);
            }
        });
    }, { threshold: 0.2, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.section-title-type').forEach(el => {
        el.querySelectorAll('.type-part').forEach(p => p.textContent = '');
        typeObserver.observe(el);
    });

    window.addEventListener('resize', () => {
        document.querySelectorAll('.section-title-type.typed-done').forEach(el => {
            const underline = el.nextElementSibling;
            if (underline && underline.classList.contains('dynamic-underline')) {
                underline.style.width = el.offsetWidth + 'px';
            }
        });
    });

    // ===== HERO TYPING (looping) =====
    (function () {
        const line1El      = document.getElementById('heroLine1');
        const line2El      = document.getElementById('heroLine2Typed');
        const line2Static  = document.getElementById('heroLine2Static');
        const HERO_LINE1   = 'Selamat Datang';
        const HERO_LINE2   = 'HIMADIKTI';
        line2Static.style.opacity = '0';

        function typeStr(el, text, speed, cb) {
            let i = 0; el.textContent = '';
            (function step() { if (i < text.length) { el.textContent += text[i++]; setTimeout(step, speed); } else if (cb) cb(); })();
        }
        function eraseStr(el, speed, cb) {
            (function step() { if (el.textContent.length > 0) { el.textContent = el.textContent.slice(0,-1); setTimeout(step, speed); } else if (cb) cb(); })();
        }
        function heroLoop() {
            typeStr(line1El, HERO_LINE1, 85, () => {
                line2Static.style.opacity = '1';
                typeStr(line2El, HERO_LINE2, 85, () => {
                    setTimeout(() => {
                        eraseStr(line2El, 40, () => {
                            line2Static.style.opacity = '0';
                            eraseStr(line1El, 40, () => setTimeout(heroLoop, 500));
                        });
                    }, 2000);
                });
            });
        }
        setTimeout(heroLoop, 900);
    })();

    // ===== CARD SLIDER (pengurus & divisi) =====
    const sliders = {
        inti:     { index: 0, total: 5, autoTimer: null },
        internal: { index: 0, total: 9, autoTimer: null }
    };

    function getVisible() {
        if (window.innerWidth < 768)  return 1;
        if (window.innerWidth < 1024) return 2;
        return 3;
    }
    function buildDots(id) {
        const s = sliders[id], vis = getVisible(), tot = Math.max(0, s.total - vis + 1);
        const con = document.getElementById('dots-' + id);
        con.innerHTML = '';
        for (let i = 0; i < tot; i++) {
            const btn = document.createElement('button');
            btn.className = 'inline-block h-2 border-0 cursor-pointer transition-all duration-300 rounded-full';
            btn.style.background = i === s.index ? '#ea580c' : 'rgba(234,88,12,0.3)';
            btn.style.width      = i === s.index ? '24px' : '8px';
            btn.style.borderRadius = i === s.index ? '4px' : '50%';
            btn.onclick = () => { goTo(id, i); restartAuto(id); };
            con.appendChild(btn);
        }
    }
    function updateDots(id) {
        document.querySelectorAll(`#dots-${id} button`).forEach((d, i) => {
            if (i === sliders[id].index) { d.style.background = '#ea580c'; d.style.width = '24px'; d.style.borderRadius = '4px'; }
            else { d.style.background = 'rgba(234,88,12,0.3)'; d.style.width = '8px'; d.style.borderRadius = '50%'; }
        });
    }
    function goTo(id, idx) {
        const s = sliders[id], vis = getVisible(), max = Math.max(0, s.total - vis);
        s.index = Math.min(Math.max(idx, 0), max);
        const track = document.getElementById('track-' + id);
        const cardW = track.children[0].offsetWidth + 16;
        track.style.transform = `translateX(-${s.index * cardW}px)`;
        updateDots(id);
    }
    function slide(id, dir) { goTo(id, sliders[id].index + dir); restartAuto(id); }
    function startAuto(id) {
        sliders[id].autoTimer = setInterval(() => {
            const vis = getVisible(), max = Math.max(0, sliders[id].total - vis);
            goTo(id, sliders[id].index >= max ? 0 : sliders[id].index + 1);
        }, 3500);
    }
    function restartAuto(id) { clearInterval(sliders[id].autoTimer); startAuto(id); }

    window.addEventListener('DOMContentLoaded', () => {
        ['inti', 'internal'].forEach(id => { buildDots(id); startAuto(id); });
    });
    window.addEventListener('resize', () => {
        ['inti', 'internal'].forEach(id => { buildDots(id); goTo(id, sliders[id].index); });
    });

    // ===== SLIDER PRESTASI =====
    document.addEventListener('DOMContentLoaded', function () {
        const prestasislides = document.querySelectorAll('.auto-slide');
        let currentPrestasi  = 0;
        setInterval(() => {
            prestasislides[currentPrestasi].classList.remove('opacity-100', 'z-10');
            prestasislides[currentPrestasi].classList.add('opacity-0', 'z-0');
            currentPrestasi = (currentPrestasi + 1) % prestasislides.length;
            prestasislides[currentPrestasi].classList.remove('opacity-0', 'z-0');
            prestasislides[currentPrestasi].classList.add('opacity-100', 'z-10');
        }, 4000);
    });

    // ===== PROKER: COUNTER ANIMASI =====
    (function () {
        const counters = document.querySelectorAll('.pk-counter-val[data-target]');
        if (!counters.length) return;
        const obs = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                obs.unobserve(entry.target);
                const el = entry.target, target = +el.dataset.target, dur = 1600, start = performance.now();
                (function tick(now) {
                    const elapsed = now - start, prog = Math.min(elapsed / dur, 1);
                    const eased = 1 - Math.pow(1 - prog, 3);
                    el.textContent = Math.round(eased * target).toLocaleString('id');
                    if (prog < 1) requestAnimationFrame(tick);
                })(start);
            });
        }, { threshold: 0.4 });
        counters.forEach(c => obs.observe(c));
    })();

    // ===== PROKER: PROGRESS RING ANIMASI =====
    (function () {
        const rings = document.querySelectorAll('.pk-ring-fill');
        if (!rings.length) return;
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('animated'); obs.unobserve(e.target); } });
        }, { threshold: 0.3 });
        rings.forEach(r => obs.observe(r));
    })();

    // ===== PROKER: FILTER DIVISI =====
    (function () {
        const btns = document.querySelectorAll('.pk-filter-btn');
        if (!btns.length) return;
        btns.forEach(btn => {
            btn.addEventListener('click', function () {
                btns.forEach(b => b.classList.remove('pk-active'));
                this.classList.add('pk-active');
                const filter = this.dataset.filter;
                document.querySelectorAll('#pk-grid .pk-card').forEach(card => {
                    const match = filter === 'semua' || card.dataset.divisi === filter;
                    card.style.display   = match ? '' : 'none';
                    card.style.opacity   = '0';
                    card.style.transform = 'translateY(12px)';
                    if (match) {
                        requestAnimationFrame(() => {
                            card.style.transition = 'opacity .35s ease, transform .35s ease';
                            card.style.opacity    = '1';
                            card.style.transform  = 'translateY(0)';
                        });
                    }
                });
                const lmBtn = document.getElementById('pk-load-more-btn');
                if (lmBtn) lmBtn.style.display = filter === 'semua' ? '' : 'none';
            });
        });
    })();

    // ===== PROKER: LOAD MORE =====
    function pkLoadMore() {
        const items = document.querySelectorAll('.pk-loadmore-item');
        items.forEach((el, i) => {
            el.classList.remove('pk-hidden', 'pk-loadmore-item');
            el.style.opacity   = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'opacity .4s ease, transform .4s ease';
                el.style.opacity    = '1';
                el.style.transform  = 'translateY(0)';
            }, i * 60);
        });
        const btn = document.getElementById('pk-load-more-btn');
        if (btn) btn.classList.add('hidden');
    }

    // ===== PROKER: LIGHTBOX =====
    function pkOpenLightbox(data) {
        const lb      = document.getElementById('pk-lightbox');
        const imgWrap = document.getElementById('pk-lb-img-wrap');
        const img     = document.getElementById('pk-lb-img');

        if (data.foto) { img.src = data.foto; img.alt = data.title; imgWrap.style.display = ''; }
        else imgWrap.style.display = 'none';

        document.getElementById('pk-lb-title').textContent  = data.title;
        document.getElementById('pk-lb-divisi').textContent = data.divisi || '—';
        document.getElementById('pk-lb-ketua').textContent  = data.ketua  || '—';
        document.getElementById('pk-lb-tgl').textContent    = data.tgl    || '—';
        document.getElementById('pk-lb-desc').textContent   = data.desc   || '—';

        const partStat = document.getElementById('pk-lb-stat-part');
        if (data.partisipan > 0) { document.getElementById('pk-lb-part').textContent = data.partisipan + ' anggota'; partStat.style.display = ''; }
        else partStat.style.display = 'none';

        const angStat = document.getElementById('pk-lb-stat-ang');
        if (data.anggaran) { document.getElementById('pk-lb-ang').textContent = data.anggaran; angStat.style.display = ''; }
        else angStat.style.display = 'none';

        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function pkCloseLightbox() {
        document.getElementById('pk-lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
    function pkCloseLightboxOutside(e) {
        if (e.target === document.getElementById('pk-lightbox')) pkCloseLightbox();
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') pkCloseLightbox(); });
    </script>
</body>
</html>