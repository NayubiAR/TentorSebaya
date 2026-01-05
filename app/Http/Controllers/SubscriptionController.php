<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    // 1. Tampilkan Halaman Penawaran Premium
    public function index()
    {
        return view('subscription.index');
    }

    // 2. Proses Upgrade Akun (Simulasi Pembayaran)
    public function upgrade()
    {
        $user = Auth::user();

        // Ubah status user jadi premium
        $user->update([
            'is_premium' => true
        ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Selamat! Akun Anda sekarang Premium.');
    }
}
