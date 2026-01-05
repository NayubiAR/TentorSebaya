<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CourseController extends Controller
{
    // MENAMPILKAN DAFTAR KELAS
    public function index()
    {
        // Ambil data kursus, urutkan dari yang terbaru
        $courses = Course::with('category')->latest()->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    // FORM TAMBAH KELAS
    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::all();

        return view('admin.courses.create', compact('categories'));
    }

    // PROSES SIMPAN KELAS
    // UPDATE METHOD INI:
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'access_type' => 'required', // <--- Ganti validasi price jadi ini
            'duration' => 'required|string',
            'video_url' => 'required|string',
        ]);

        // 2. Tentukan Harga berdasarkan Tipe Akses
        // Logika sistem kita: Price 0 = Gratis, Price > 0 = Premium
        $price = ($request->access_type == 'premium') ? 100000 : 0;

        // 3. Simpan ke Database
        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $price, // <--- Masukkan hasil logika di atas
            'duration' => $request->duration,
            'video_url' => $request->video_url,
            'is_published' => true,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    // MENAMPILKAN FORM EDIT
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    // PROSES UPDATE DATA
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'access_type' => 'required',
            'duration' => 'required|string',
            'video_url' => 'required|string',
        ]);

        // Cek lagi: Gratis atau Premium?
        $price = ($request->access_type == 'premium') ? 100000 : 0;

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $price,
            'duration' => $request->duration,
            'video_url' => $request->video_url,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    // PROSES HAPUS DATA
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
