<?php

namespace App\Http\Controllers;

use App\Models\LogConnexion;
use Illuminate\Http\Request;
use App\Models\Utilisateur;

class LogConnexionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $utilisateurId = $request->input('utilisateur_id');
        $type = $request->input('type');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
    
        $query = LogConnexion::with('utilisateur')->latest();
    
        if ($search) {
            $query->whereHas('utilisateur', function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
    
        if ($utilisateurId && $utilisateurId !== 'all') {
            $query->where('utilisateur_id', $utilisateurId);
        }
    
        if ($type && $type !== 'all') {
            $query->whereHas('utilisateur', fn($q) => $q->where('type_utilisateur', $type));
        }
    
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
    
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
    
        $logs = $query->paginate(15)->withQueryString();
        $utilisateurs = \App\Models\Utilisateur::orderBy('nom')->get();
    
        return view('logs.index', compact('logs', 'utilisateurs', 'search', 'utilisateurId', 'type', 'dateFrom', 'dateTo'));
    }
    
}
