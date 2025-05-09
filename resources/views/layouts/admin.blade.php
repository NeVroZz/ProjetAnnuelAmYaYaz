<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'EcoDeli Admin')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }
    .sidebar {
        height: 100vh;
        background-color: #343a40;
        color: white;
        padding-top: 20px;
        position: fixed;
        width: 220px;
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px 20px;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .main-content {
        margin-left: 220px;
        padding: 20px;
    }
    .badge-role {
        font-size: 0.8rem;
    }
    .pagination {
        justify-content: center;
    }
    .pagination svg {
        display: none !important;
    }
    .pagination nav > div:first-child {
        display: none !important;
    }
</style>

</head>
<body>

    <div class="sidebar">
        <h5 class="text-center mb-4">EcoDeli Admin</h5>
        <a href="{{ route('dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('utilisateurs.index') }}">👤 Utilisateurs</a>
        <a href="{{ route('logs.index') }}">🔍 Connexions</a>
        <a href="{{ route('modifications.index') }}">🛠️ Modifications</a>

        <!-- Ajoute d'autres liens ici si besoin -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4 text-center">
            @csrf
            <button class="btn btn-danger btn-sm">Se déconnecter</button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
