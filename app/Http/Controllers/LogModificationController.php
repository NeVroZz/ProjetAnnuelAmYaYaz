<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogModification;
use App\Models\Utilisateur;

class LogModificationController extends Controller
{
    public function index(Request $request)
    {
        $adminId = $request->input('admin_id');
        $userId = $request->input('utilisateur_id');

        $query = LogModification::with('admin', 'utilisateur')->latest();

        if ($adminId && $adminId !== 'all') {
            $query->where('admin_id', $adminId);
        }

        if ($userId && $userId !== 'all') {
            $query->where('utilisateur_id', $userId);
        }

        $logs = $query->paginate(20);

        $admins = Utilisateur::where('type_utilisateur', 'admin')->get();
        $utilisateurs = Utilisateur::all();

        return view('logs.modifications', compact('logs', 'admins', 'utilisateurs'));
    }
}
