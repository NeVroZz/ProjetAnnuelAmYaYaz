<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion Utilisateurs')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 90%;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            white-space: nowrap;
        }
        .pagination {
            justify-content: center;
        }
        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .page-item .page-link {
            color: #007bff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark mb-3">
        <div class="container d-flex justify-content-start">
            <a href="{{ route('dashboard') }}" class="btn btn-light">
                Dashboard
            </a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
