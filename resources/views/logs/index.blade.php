@extends('layouts.admin')

@section('title', 'Historique de Connexions')

@section('content')
    <h2 class="mb-4">Historique de Connexions</h2>

        <form method="GET" action="{{ route('logs.index') }}" class="row row-cols-lg-auto g-3 mb-4 align-items-end">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
            </div>

            <div class="col">
                <select name="utilisateur_id" class="form-select">
                    <option value="all">Tous les utilisateurs</option>
                    @foreach($utilisateurs as $user)
                        <option value="{{ $user->id_utilisateur }}" {{ request('utilisateur_id') == $user->id_utilisateur ? 'selected' : '' }}>
                            {{ $user->prenom }} {{ $user->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <select name="type" class="form-select">
                    <option value="all">Tous les rôles</option>
                    @foreach(['admin', 'client', 'commercant', 'livreur', 'prestataire'] as $role)
                        <option value="{{ $role }}" {{ request('type') === $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label class="form-label">De</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>

            <div class="col">
                <label class="form-label">À</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>

            <div class="col">
                <button class="btn btn-primary">Filtrer</button>
                <a href="{{ route('logs.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
            </div>
        </form>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Adresse IP</th>
                    <th>Agent</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $log->utilisateur->prenom }} {{ $log->utilisateur->nom }}</td>
                    <td>{{ $log->utilisateur->email }}</td>
                    <td>{{ $log->ip }}</td>
                    <td>{{ Str::limit($log->user_agent, 40) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 d-flex justify-content-center">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
