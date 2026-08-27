<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | SAV Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f5f7fb; }
        .sidebar { min-height: 100vh; background: #0f172a; }
        .sidebar .nav-link { color: rgba(255,255,255,.7); }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,.08); }
        .content-wrapper { min-height: 100vh; }
        /* Fix Laravel pagination arrows */
nav svg {
    width: 20px !important;
    height: 20px !important;
}
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-2 sidebar p-3">
            <h3 class="text-white mb-4">SAV Manager</h3>
           <nav class="nav flex-column gap-1">
    <a class="nav-link @if(request()->is('dashboard')) active @endif"
       href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
    </a>

    <a class="nav-link @if(request()->is('clients*')) active @endif"
       href="{{ route('clients.index') }}">
        <i class="bi bi-people me-2"></i>Clients
    </a>

    <a class="nav-link @if(request()->is('devices*')) active @endif"
       href="{{ route('devices.index') }}">
        <i class="bi bi-laptop me-2"></i>Appareils
    </a>

    <a class="nav-link @if(request()->is('tickets*')) active @endif"
       href="{{ route('tickets.index') }}">
        <i class="bi bi-ticket-perforated me-2"></i>Tickets SAV
    </a>

    @can('manage-repairs')
        <a class="nav-link @if(request()->is('repairs*')) active @endif"
           href="{{ route('repairs.index') }}">
            <i class="bi bi-tools me-2"></i>Interventions
        </a>
    @endcan

    @can('manage-technicians')
        <a class="nav-link @if(request()->is('technicians*')) active @endif"
           href="{{ route('technicians.index') }}">
            <i class="bi bi-person-badge me-2"></i>Techniciens
        </a>
    @endcan

    @can('manage-spare-parts')
        <a class="nav-link @if(request()->is('spare-parts*')) active @endif"
           href="{{ route('spare-parts.index') }}">
            <i class="bi bi-box-seam me-2"></i>Pièces
        </a>
    @endcan
<a class="nav-link @if(request()->is('reports*')) active @endif" href="{{ route('reports.index') }}">
    <i class="bi bi-bar-chart me-2"></i>Rapports
</a>
</nav>
        </aside>
        <main class="col-md-10 content-wrapper p-4">
            <nav class="navbar navbar-light bg-white rounded shadow-sm mb-4 px-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">@yield('title')</span>
                    <div class="d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><span class="dropdown-item text-muted small">Rôle: {{ match(auth()->user()->role) {
                                    'admin' => 'Administrateur',
                                    'receptionist' => 'Réception',
                                    'technician' => 'Technicien',
                                    default => ucfirst(auth()->user()->role),
                                } }}</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Se déconnecter</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
