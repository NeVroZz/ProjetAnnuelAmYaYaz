@extends('layouts.admin')

@section('title', 'Historique des Modifications')

@section('content')
    <h2 class="mb-4">Historique des Modifications</h2>

    <div class="bg-white p-3 rounded shadow">
        <ul class="list-group">
            @foreach($logs as $log)
                <li class="list-group-item">
                    {{ $log->created_at->format('d/m/Y H:i') }} - 
                    <strong>{{ $log->admin->prenom }} {{ $log->admin->nom }}</strong> 
                    a effectué : {{ $log->action }} - 
                    <em>{{ $log->details }}</em>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
@endsection
