<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; // Jangan lupa import Model
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Method untuk menampilkan halaman detail kelas
    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        // Default: Akses ditolak
        $isAccessGranted = false;

        // LOGIKA BARU:
        // 1. Jika video GRATIS (price 0) -> Boleh nonton
        if ($course->price == 0) {
            $isAccessGranted = true;
        }
        // 2. Jika video BERBAYAR, cek apakah user PREMIUM
        elseif (Auth::check() && Auth::user()->is_premium) {
            $isAccessGranted = true;
        }

        return view('courses.show', compact('course', 'isAccessGranted'));
    }
}
