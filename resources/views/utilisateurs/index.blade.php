@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>User Management</h2>
        <form method="GET" action="{{ route('utilisateurs.index') }}" class="d-flex flex-wrap gap-2 align-items-center" role="search">
                <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">

                <select name="role" class="form-select">
                    <option value="all">Tous les rôles</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="client" {{ request('role') === 'client' ? 'selected' : '' }}>Client</option>
                    <option value="commercant" {{ request('role') === 'commercant' ? 'selected' : '' }}>Commerçant</option>
                    <option value="livreur" {{ request('role') === 'livreur' ? 'selected' : '' }}>Livreur</option>
                    <option value="prestataire" {{ request('role') === 'prestataire' ? 'selected' : '' }}>Prestataire</option>
                </select>

                    <select name="verifie" class="form-select">
                        <option value="all">Tous</option>
                        <option value="1" {{ request('verifie') === '1' ? 'selected' : '' }}>Vérifiés</option>
                        <option value="0" {{ request('verifie') === '0' ? 'selected' : '' }}>Non vérifiés</option>
                    </select>

                <div class="form-check ms-2">
                    <input class="form-check-input" type="checkbox" name="show_inactive" value="1" {{ request('show_inactive') ? 'checked' : '' }}>
                    <label class="form-check-label">Inclure inactifs</label>
                </div>

                <button type="submit" class="btn btn-primary">Filtrer</button>

                <a href="{{ route('utilisateurs.index') }}" class="btn btn-outline-secondary">
                    Réinitialiser
                </a>
            </form>


    </div>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Vérification</th>
                    <th>Statut</th>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $utilisateur)
                <tr>
                    <td>
                        <span class="badge bg-{{ $utilisateur->verifie ? 'success' : 'secondary' }}">
                            {{ $utilisateur->verifie ? 'Vérifié' : 'Non vérifié' }}
                        </span>
                    </td>

                    <td>
                        <span class="badge bg-{{ $utilisateur->actif ? 'success' : 'secondary' }}">
                            {{ $utilisateur->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>

                    <td>{{ $utilisateur->id_utilisateur }}</td>
                    <td>{{ $utilisateur->nom }}</td>
                    <td>{{ $utilisateur->prenom }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $utilisateur->type_utilisateur === 'admin' ? 'danger' :
                            ($utilisateur->type_utilisateur === 'client' ? 'primary' :
                            ($utilisateur->type_utilisateur === 'commercant' ? 'warning' :
                            ($utilisateur->type_utilisateur === 'livreur' ? 'success' : 'info')))
                        }} badge-role">
                            {{ ucfirst($utilisateur->type_utilisateur) }}
                        </span>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('utilisateurs.edit', $utilisateur->id_utilisateur) }}">Modifier</a>
                                </li>
                                <li>
                                    <form action="{{ route('utilisateurs.destroy', $utilisateur->id_utilisateur) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger">Supprimer</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('utilisateurs.toggleVerification', $utilisateur->id_utilisateur) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="dropdown-item">
                                            {{ $utilisateur->verifie ? 'Annuler vérification' : 'Vérifier' }}
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('utilisateurs.toggle', $utilisateur->id_utilisateur) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="dropdown-item">
                                            {{ $utilisateur->actif ? 'Désactiver' : 'Activer' }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 d-flex justify-content-center">
            {{ $utilisateurs->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
