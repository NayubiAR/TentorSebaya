<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // TAMPILKAN DAFTAR KATEGORI
    public function index()
    {
        $categories = Category::withCount('courses')->latest()->get(); // withCount untuk hitung jumlah kelas di kategori ini
        return view('admin.categories.index', compact('categories'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.categories.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            // Image icon opsional, nanti saja kalau mau advance
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // FORM EDIT
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE DATA
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // HAPUS DATA
    public function destroy(Category $category)
    {
        // Opsional: Cek apakah kategori ini masih punya kelas?
        if($category->courses()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Masih ada kelas yang menggunakan kategori ini.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
