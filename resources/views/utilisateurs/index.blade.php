@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Liste des Utilisateurs</h2>

    <!-- Barre de recherche -->
    <div class="d-flex justify-content-center mb-3">
        <form method="GET" action="{{ route('utilisateurs.index') }}" class="d-flex w-50">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-control me-2">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
    <!-- Pagination centrée propre -->
    <div class="d-flex justify-content-center mt-3">
        {!! $utilisateurs->onEachSide(1)->links('pagination::bootstrap-5') !!}
    </div>
    <!-- Tableau des utilisateurs -->
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $utilisateur)
                <tr>
                    <td>{{ $utilisateur->id_utilisateur }}</td>
                    <td>{{ $utilisateur->nom }}</td>
                    <td>{{ $utilisateur->prenom }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($utilisateur->type_utilisateur) }}</span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('utilisateurs.destroy', $utilisateur->id_utilisateur) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination centrée -->
    <div class="d-flex justify-content-center mt-3">
        {!! $utilisateurs->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection
