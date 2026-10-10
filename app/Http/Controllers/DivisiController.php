<?php

namespace App\Http\Controllers;

use App\Models\LandingPhoto;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function show($slug)
    {
        $divisiCard = LandingPhoto::where('section', 'divisi')
            ->where('link', $slug)
            ->where('is_active', true)
            ->first();

        abort_if(!$divisiCard, 404);

        $prokers = LandingPhoto::where('section', 'divisi_proker')
            ->forDivisi($slug)
            ->get()
            ->map(fn ($p) => [
                'icon'   => $p->subtitle ?: '⭐',
                'title'  => $p->title,
                'detail' => $p->description,
            ])
            ->values()
            ->all();

        $staffs = LandingPhoto::where('section', 'divisi_staff')
            ->forDivisi($slug)
            ->get()
            ->map(fn ($s) => [
                'photo' => $s->photo_url ?? asset('images/himadikti.png'),
                'name'  => $s->title,
                'role'  => $s->subtitle,
            ])
            ->values()
            ->all();

        $data = [
            'name'    => $divisiCard->title,
            'desc'    => $divisiCard->description,
            'img'     => $divisiCard->photo_url ?? asset('images/himadikti.png'),
            'prokers' => $prokers,
            'staffs'  => $staffs,
        ];

        return view('divisi.show', compact('data'));
    }
}
