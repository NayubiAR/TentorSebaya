<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaction;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_premium',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Fungsi sakti untuk mengecek apakah user sudah beli kelas tertentu
    public function hasPurchasedCourse($courseId)
    {
        // Cek apakah ada transaksi dengan status 'success' untuk course_id tersebut
        return $this->transactions()
                    ->where('course_id', $courseId)
                    ->where('status', 'success') // Pastikan statusnya sukses
                    ->exists(); // Mengembalikan true/false
    }

    public function canAccessPremiumContent()
    {
        return $this->is_premium;
    }
}
