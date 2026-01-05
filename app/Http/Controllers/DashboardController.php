<?php

namespace App\Http\Controllers;

use App\Models\Category; // <--- Tambahkan Import Category
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Data Kursus dengan Filter
        $courses = Course::with('category')
            ->latest()
            // Logika Pencarian (Jika ada input 'search')
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            // Logika Kategori (Jika ada input 'category')
            ->when($request->category, function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            })
            ->get();

        // 2. Ambil Semua Kategori (Untuk tombol filter di view)
        $categories = Category::all();

        return view('dashboard', compact('courses', 'categories'));
    }
}
