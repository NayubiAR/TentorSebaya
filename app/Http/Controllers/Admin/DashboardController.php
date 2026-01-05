<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Kelas
        $totalCourses = Course::count();

        // 2. Hitung Total User (Kecuali Admin)
        $totalUsers = User::where('role', 'user')->count();

        // 3. Hitung User Premium
        $premiumUsers = User::where('role', 'user')->where('is_premium', true)->count();

        return view('admin.dashboard', compact('totalCourses', 'totalUsers', 'premiumUsers'));
    }
}
