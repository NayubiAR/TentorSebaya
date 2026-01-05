<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Transaction; // <--- JANGAN LUPA IMPORT MODEL INI
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ================================
        // 1. BUAT AKUN ADMIN
        // ================================
        $admin = User::create([
            'name' => 'Admin Tentor',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@gmail.com'),
        ]);

        // ================================
        // 2. BUAT KATEGORI
        // ================================
        $catIT = Category::create(['name' => 'IT & Software', 'slug' => 'it-software']);
        $catDesain = Category::create(['name' => 'Desain Grafis', 'slug' => 'desain-grafis']);
        $catBahasa = Category::create(['name' => 'Bahasa Asing', 'slug' => 'bahasa-asing']);
        $catKarir = Category::create(['name' => 'Pengembangan Karir', 'slug' => 'pengembangan-karir']);
        $catFullstack = Category::create(['name' => 'Fullstack', 'slug' => 'fullstack']);
        $catCS = Category::create(['name' => 'CS Dasar', 'slug' => 'cs-dasar']);

        // ================================
        // 3. BUAT COURSE (VIDEO KELAS)
        // ================================

        // Kelas 1 (Gratis)
        Course::create([
            'category_id' => $catIT->id,
            'title' => 'Pengenalan Laravel 11',
            'slug' => 'pengenalan-laravel-11',
            'description' => 'Video pengenalan dasar framework Laravel, instalasi, dan struktur folder.',
            'price' => 0,
            'duration' => '45 Menit',
            'video_url' => 'dQw4w9WgXcQ', // ID Video Youtube
            'is_published' => true,
        ]);

        // Kelas 2 (Berbayar - Nanti kita buat seolah-olah sudah dibeli)
        $coursePremium = Course::create([
            'category_id' => $catDesain->id,
            'title' => 'Mastering UI/UX Design',
            'slug' => 'mastering-ui-ux-design',
            'description' => 'Panduan lengkap membuat desain aplikasi mobile yang estetik dan user-friendly.',
            'price' => 250000,
            'duration' => '12 Jam',
            'video_url' => 'kZ8jXQz7hF0', // ID Video Youtube Random
            'is_published' => true,
        ]);

        // Kelas 3 (Gratis)
        Course::create([
            'category_id' => $catBahasa->id,
            'title' => 'Basic English Conversation',
            'slug' => 'basic-english-conversation',
            'description' => 'Latihan percakapan bahasa Inggris sehari-hari untuk pemula.',
            'price' => 0,
            'duration' => '1 Jam 30 Menit',
            'video_url' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);

        // Kelas 4 (Berbayar - Belum dibeli)
        Course::create([
            'category_id' => $catFullstack->id,
            'title' => 'Fullstack Web Development',
            'slug' => 'fullstack-web-development',
            'description' => 'Bangun website toko online dari nol sampai deploy ke server.',
            'price' => 500000,
            'duration' => '24 Jam',
            'video_url' => 'dQw4w9WgXcQ',
            'is_published' => true,
        ]);

        // ... tambahkan kelas lain jika perlu ...

        // =======================================================
        // 4. BUAT TRANSAKSI PALSU (SEEDER UNTUK TESTING AKSES)
        // =======================================================

        // Skenario: Admin SUDAH MEMBELI kelas "Mastering UI/UX Design"
        Transaction::create([
            'user_id' => $admin->id,          // User Admin
            'course_id' => $coursePremium->id, // Kelas UI/UX
            'invoice_code' => 'TRX-DUMMY-001',
            'amount' => $coursePremium->price,
            'status' => 'success',            // STATUS SUKSES (Kunci agar gembok terbuka)
            'snap_token' => 'dummy-token-123'
        ]);
    }
}
