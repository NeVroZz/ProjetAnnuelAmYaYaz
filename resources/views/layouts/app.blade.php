<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Utilisateurs')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('utilisateurs.index') }}">Gestion Utilisateurs</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
