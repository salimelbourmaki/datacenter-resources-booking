<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DataCenter Manager') }}</title>

    <!-- CSS -->
    @vite(['resources/css/layouts/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    @stack('styles')

    <!-- Dark Mode Initial Check -->
    @vite(['resources/js/theme-init.js'])
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Logo & Brand -->
            <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                class="navbar-brand">
                <img src="{{ asset('images/dclogo.png') }}" alt="Logo DC-Manager" class="navbar-logo">
            </a>

            <!-- Navigation Links -->
            <ul class="navbar-nav">
                @auth
                    @php
                        $currentRole = auth()->user()->role;
                        if ($currentRole === 'admin' && session()->has('impersonated_role')) {
                            $currentRole = session('impersonated_role');
                        }
                    @endphp

                    <!-- 1. Dashboard -->
                    <li>
                        <a href="{{ $currentRole === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                    </li>

                    <!-- 2. Catalogue -->
                    <li>
                        <a href="{{ route('resources.index') }}"
                            class="{{ request()->routeIs('resources.index') ? 'active' : '' }}">
                            <i class="fas fa-server"></i> Catalogue
                        </a>
                    </li>

                    <!-- GESTION (RESPONSABLE/ADMIN) -->
                    @if($currentRole === 'responsable' || $currentRole === 'admin')
                        <li>
                            <a href="{{ route('resources.manager') }}"
                                class="{{ request()->routeIs('resources.manager') ? 'active' : '' }}">
                                <i class="fas fa-tasks"></i> Ma Gestion
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('incidents.manager') }}"
                                class="{{ request()->routeIs('incidents.manager') ? 'active' : '' }}">
                                <i class="fas fa-exclamation-triangle"></i> Incidents
                            </a>
                        </li>
                    @endif

                    @if($currentRole === 'user')
                        <li>
                            <a href="{{ route('reservations.index') }}"
                                class="{{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                                <i class="fas fa-calendar-check"></i> Mes Réservations
                            </a>
                        </li>
                    @endif

                    @if($currentRole === 'admin')
                        <li>
                            <a href="{{ route('admin.users') }}"
                                class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                                <i class="fas fa-users"></i> Utilisateurs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logs') }}" class="{{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                                <i class="fas fa-history"></i> Logs
                            </a>
                        </li>
                    @endif
                @else
                    <!-- 2. Catalogue (Guest) -->
                    <li>
                        <a href="{{ route('resources.index') }}"
                            class="{{ request()->routeIs('resources.index') ? 'active' : '' }}">
                            <i class="fas fa-server"></i> Catalogue
                        </a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side: Utils & User Area -->
            <div class="navbar-right">
                <!-- Group 3: Utility Tools -->
                <div class="navbar-utils">
                    <!-- Notifications -->
                    @auth
                        <a href="{{ route('notifications.index') }}"
                            class="nav-util-link {{ request()->routeIs('notifications.index') ? 'active' : '' }}"
                            title="Notifications">
                            <i class="fas fa-bell"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="notification-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                    @endauth

                    <!-- À Propos -->
                    <a href="{{ route('about') }}"
                        class="nav-util-link {{ request()->routeIs('about') ? 'active' : '' }}" title="À Propos">
                        <i class="fas fa-info-circle"></i>
                    </a>

                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="btn-theme-toggle" title="Basculer le thème">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>


                <!-- User Area -->
                <div class="navbar-user">
                    @auth
                        <div class="user-info">
                            <a href="{{ route('profile.edit') }}" title="Mon Profil"
                                style="text-decoration: none; color: inherit; display: flex; flex-direction: column; align-items: flex-end;">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-role">
                                    @php
                                        $currentRole = auth()->user()->role;
                                        if ($currentRole === 'admin' && session()->has('impersonated_role')) {
                                            $currentRole = session('impersonated_role');
                                        }
                                        $roles = [
                                            'admin' => 'Administrateur',
                                            'responsable' => 'Responsable Tech',
                                            'user' => 'Ingénieur Réseau',
                                            'guest' => 'Invité'
                                        ];
                                    @endphp
                                    {{ $roles[$currentRole] ?? $currentRole }}
                                </div>
                            </a>
                        </div>
                        
                        <!-- PROFILE SWITCHER (Only for Admin/Creator) -->
                        @if(auth()->user()->role === 'admin')
                            <div class="profile-switcher">
                                <form action="{{ route('admin.switch-role') }}" method="POST" id="role-switch-form">
                                    @csrf
                                    <select name="role" onchange="this.form.submit()" class="role-select">
                                        <option value="admin" {{ (session('impersonated_role') ?? auth()->user()->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="responsable" {{ session('impersonated_role') === 'responsable' ? 'selected' : '' }}>Responsable</option>
                                        <option value="user" {{ session('impersonated_role') === 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </form>
                            </div>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-logout" title="Se déconnecter">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <div class="auth-buttons-guest">
                            <a href="{{ route('login') }}" class="btn-auth-nav btn-login-nav">SE CONNECTER</a>
                            <a href="{{ route('register') }}" class="btn-auth-nav btn-register-nav">S'INSCRIRE</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENU PRINCIPAL -->
    <main class="main-content">
        @auth
            @php
                $tomorrow = \Carbon\Carbon::tomorrow()->toDateString();
                $expiringTomorrow = auth()->user()->reservations()
                    ->whereIn('status', ['Approuvée', 'Active'])
                    ->whereDate('end_date', $tomorrow)
                    ->count();
            @endphp

            @if($expiringTomorrow > 0)
                <div class="expiry-banner">
                    <div class="expiry-banner-content">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Attention : Vous avez <strong>{{ $expiringTomorrow }}</strong>
                            réservation{{ $expiringTomorrow > 1 ? 's' : '' }} qui se
                            termine{{ $expiringTomorrow > 1 ? 'nt' : '' }} demain.</span>
                        <a href="{{ route('reservations.index') }}" class="expiry-banner-link">Gérer mes réservations</a>
                    </div>
                </div>
            @endif
        @endauth

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        <p>&copy; {{ date('Y') }} - Gestion de Ressources Data Center IDAI</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/js/app.js', 'resources/js/layouts/app.js'])

    @stack('scripts')
</body>

</html>