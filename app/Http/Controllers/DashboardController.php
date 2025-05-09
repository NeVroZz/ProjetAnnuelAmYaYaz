<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\LogModification;

class DashboardController extends Controller
{

    public function index()
    {
        $totalUsers = Utilisateur::count();
        $usersByRole = Utilisateur::select('type_utilisateur')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type_utilisateur')
            ->get();

        $recentLogs = LogModification::with('admin', 'utilisateur')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('totalUsers', 'usersByRole', 'recentLogs'));
    }
}
