@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h2 class="mb-4">Dashboard - Statistiques</h2>

    <div class="row g-3 mb-4">
        <!-- Total utilisateurs -->
        <div class="col-md-3">
            <div class="bg-primary text-white p-3 rounded shadow">
                <h5>Total Utilisateurs</h5>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </div>

        <!-- Utilisateurs par rôle -->
        @foreach($usersByRole as $roleData)
            <div class="col-md-3">
                <div class="bg-secondary text-white p-3 rounded shadow">
                    <h5>{{ ucfirst($roleData->type_utilisateur) }}</h5>
                    <h2>{{ $roleData->count }}</h2>
                </div>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-3 rounded shadow mb-4">
        <h5>Dernières modifications</h5>
        <ul class="list-group">
            @foreach($recentLogs as $log)
                <li class="list-group-item">
                    {{ $log->created_at->format('d/m/Y H:i') }} - 
                    <strong>{{ $log->admin->prenom }} {{ $log->admin->nom }}</strong> 
                    a effectué : {{ $log->action }} - 
                    <em>{{ $log->details }}</em>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white p-3 rounded shadow mb-4">
        <h4>Utilisateurs non vérifiés</h4>
        <ul class="list-group">
            @foreach($utilisateursNonVerifies as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $user->prenom }} {{ $user->nom }} - {{ $user->email }}
                    <form action="{{ route('utilisateurs.verification', $user->id_utilisateur) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success">Vérifier</button>
                    </form>


                </li>
            @endforeach
        </ul>
    </div>


@endsection
