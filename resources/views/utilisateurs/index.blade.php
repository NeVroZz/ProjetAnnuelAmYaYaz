@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>User Management</h2>
        <form method="GET" action="{{ route('utilisateurs.index') }}" class="d-flex" role="search">
            <input type="text" name="search" class="form-control me-2" placeholder="Search users..." value="{{ request('search') }}">
            <button class="btn btn-primary">Apply Filters</button>
        </form>
    </div>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $utilisateur)
                <tr>
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
                                <li><a class="dropdown-item" href="{{ route('utilisateurs.edit', $utilisateur->id_utilisateur) }}">Modifier</a></li>
                                <li><form action="{{ route('utilisateurs.destroy', $utilisateur->id_utilisateur) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item text-danger">Supprimer</button>
                                </form></li>

                                <form action="{{ route('utilisateurs.toggle', $utilisateur->id_utilisateur) }}" method="POST" onsubmit="return confirm('Changer l’état de cet utilisateur ?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="dropdown-item">
                                        {{ $utilisateur->actif ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>

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
