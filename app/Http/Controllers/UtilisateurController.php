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

    public function edit($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.edit', compact('utilisateur'));
    }

    public function update(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:utilisateurs,email,' . $id . ',id_utilisateur',
            'mot_de_passe' => 'nullable|min:6',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'ville' => 'nullable|string|max:100',
            'code_postal' => 'nullable|string|max:10',
            'type_utilisateur' => 'required|in:client,livreur,commercant,prestataire,admin',
        ]);

        if ($request->filled('mot_de_passe')) {
            $validated['mot_de_passe'] = bcrypt($request->mot_de_passe);
        } else {
            unset($validated['mot_de_passe']);
        }

        $utilisateur->update($validated);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour.');
    }


}
