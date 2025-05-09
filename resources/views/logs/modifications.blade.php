@extends('layouts.admin')

@section('title', 'Historique des Modifications')

@section('content')
    <h2 class="mb-4">Historique des Modifications</h2>

    <form method="GET" action="{{ route('modifications.index') }}" class="row row-cols-lg-auto g-3 mb-4 align-items-end">
        <div class="col">
            <select name="admin_id" class="form-select">
                <option value="all">Tous les admins</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->id_utilisateur }}" {{ request('admin_id') == $admin->id_utilisateur ? 'selected' : '' }}>
                        {{ $admin->prenom }} {{ $admin->nom }}
                    </option>
                @endforeach
            </select>
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
            <button class="btn btn-primary">Filtrer</button>
            <a href="{{ route('modifications.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
        </div>
    </form>

    <div class="bg-white p-3 rounded shadow">
        <ul class="list-group">
            @forelse($logs as $log)
                <li class="list-group-item">
                    {{ $log->created_at->format('d/m/Y H:i') }} - 
                    <strong>{{ $log->admin->prenom }} {{ $log->admin->nom }}</strong> 
                    a modifié 
                    @if ($log->utilisateur)
                        <strong>{{ $log->utilisateur->prenom }} {{ $log->utilisateur->nom }}</strong> :
                    @endif
                    <em>{{ $log->details }}</em>
                </li>
            @empty
                <li class="list-group-item">Aucune modification trouvée.</li>
            @endforelse
        </ul>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
@endsection
