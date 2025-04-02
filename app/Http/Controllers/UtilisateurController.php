<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;

class UtilisateurController extends Controller
{
    /**
     * AFFICHE LISte utilisateur 
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $utilisateurs = Utilisateur::where('nom', 'LIKE', "%$search%")
            ->orWhere('prenom', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('type_utilisateur', 'LIKE', "%$search%")
            ->paginate(10);

        return view('utilisateurs.index', compact('utilisateurs', 'search'));
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy($id)
    {
        Utilisateur::findOrFail($id)->delete();
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
