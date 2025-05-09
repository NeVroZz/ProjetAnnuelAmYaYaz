<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogModification;

class LogModificationController extends Controller
{
    public function index(Request $request)
    {
        $logs = LogModification::with('admin', 'utilisateur')
            ->latest()
            ->paginate(20);

        return view('logs.modifications', compact('logs'));
    }
}
