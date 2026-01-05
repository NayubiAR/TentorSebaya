<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // <--- WAJIB

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
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi Gambar
            'category_id' => 'required',
            'description' => 'required',
            'access_type' => 'required',
            'duration' => 'required|string',
            'video_url' => 'required|string',
        ]);

        // Proses Upload Gambar
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            // Simpan ke folder 'thumbnails' di dalam storage/app/public
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $price = ($request->access_type == 'premium') ? 100000 : 0;

        Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'thumbnail' => $thumbnailPath, // <--- Simpan path gambar
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $price,
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'description' => 'required',
            'access_type' => 'required',
            'duration' => 'required|string',
            'video_url' => 'required|string',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => ($request->access_type == 'premium') ? 100000 : 0,
            'duration' => $request->duration,
            'video_url' => $request->video_url,
        ];

        // Cek apakah user upload gambar baru?
        if ($request->hasFile('thumbnail')) {
            // 1. Hapus gambar lama jika ada (biar server gak penuh)
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            // 2. Upload gambar baru
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    // PROSES HAPUS DATA
    public function destroy(Course $course)
    {
        // Hapus gambar dari penyimpanan jika ada
        if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
