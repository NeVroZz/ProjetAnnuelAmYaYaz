<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\LogModification;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{
    /**
     * AFFICHE LISte utilisateur 
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        $showInactive = $request->boolean('show_inactive', false);
    
        $query = Utilisateur::query();
    
        // Recherche
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%$search%")
                  ->orWhere('prenom', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
            });
        }
    
        // Filtrage par rôle
        if ($role && $role !== 'all') {
            $query->where('type_utilisateur', $role);
        }
    
        // Filtrage par statut actif
        if (!$showInactive) {
            $query->where('actif', true);
        }
    
        $utilisateurs = $query->paginate(10)->withQueryString();
    
        return view('utilisateurs.index', compact('utilisateurs', 'search', 'role', 'showInactive'));
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

        LogModification::create([
            'admin_id' => Auth::id(),
            'utilisateur_id' => $utilisateur->id_utilisateur,
            'action' => 'Modification utilisateur',
            'details' => 'L’utilisateur ' . $utilisateur->prenom . ' ' . $utilisateur->nom . ' a été modifié.'
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function toggleActivation($id)
    {
        $user = Utilisateur::findOrFail($id);
        $user->actif = !$user->actif;
        $user->save();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour.');
    }



}
