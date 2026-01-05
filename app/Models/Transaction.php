<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Izinkan semua kolom diisi

    // Relasi ke User (Transaksi milik siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Course (Transaksi untuk kelas apa?)
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
