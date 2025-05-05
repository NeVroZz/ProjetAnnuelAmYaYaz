@extends('layouts.admin')

@section('title', 'Modifier Utilisateur')

@section('content')
    <h2 class="mb-4">Modifier l'utilisateur</h2>

    <form method="POST" action="{{ route('utilisateurs.update', $utilisateur->id_utilisateur) }}">
        @csrf
        @method('PUT')

        @foreach (['nom', 'prenom', 'email', 'telephone', 'adresse', 'ville', 'code_postal'] as $field)
            <div class="mb-3">
                <label class="form-label">{{ ucfirst($field) }}</label>
                <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $utilisateur->$field) }}">
            </div>
        @endforeach

        <div class="mb-3">
            <label class="form-label">Mot de passe (laisser vide pour ne pas modifier)</label>
            <input type="password" name="mot_de_passe" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Type utilisateur</label>
            <select name="type_utilisateur" class="form-select">
                @foreach(['client','livreur','commercant','prestataire','admin'] as $type)
                    <option value="{{ $type }}" {{ $utilisateur->type_utilisateur === $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
