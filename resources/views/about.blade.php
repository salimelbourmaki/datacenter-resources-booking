@extends('layouts.app')

@push('styles')
    @vite(['resources/css/about.css'])
@endpush

@section('content')
    <div class="page-header section-header">
        <h1 class="page-title" style="justify-content: center;">À Propos du <span>Data Center</span></h1>
        <p class="page-subtitle about-subtitle">
            Conditions générales d'accès et d'exploitation des ressources du Data Center IDAI.
        </p>
    </div>

    {{-- Grille des règles avec l'effet de verre (Glassmorphism) --}}
    <div class="stats-grid">
        {{-- Règle 01 : Éligibilité (SUCCESS / GREEN) --}}
        <div class="card card-accent-success">
            <div class="rule-header">
                <span class="badge rule-badge success-accent">01</span>
                <h3 class="rule-title">Éligibilité</h3>
            </div>
            <p class="rule-text">
                L'accès est réservé aux enseignants, chercheurs et doctorants disposant d'un compte actif validé. Le partage
                de compte est strictement interdit.
            </p>
        </div>

        {{-- Règle 02 : Réservations (INFO / BLUE) --}}
        <div class="card card-accent-info">
            <div class="rule-header">
                <span class="badge rule-badge info-accent">02</span>
                <h3 class="rule-title">Réservations</h3>
            </div>
            <p class="rule-text">
                Toute demande doit être justifiée. Les réservations sont limitées à 15 jours pour garantir un partage
                équitable des ressources entre les projets.
            </p>
        </div>

        {{-- Règle 03 : Interdictions (WARNING / ORANGE) --}}
        <div class="card card-accent-warning">
            <div class="rule-header">
                <span class="badge rule-badge warning-accent">03</span>
                <h3 class="rule-title">Interdictions</h3>
            </div>
            <p class="rule-text">
                Le minage de cryptomonnaie, les tests d'intrusion non autorisés et le stockage de données illégales
                entraînent une exclusion immédiate.
            </p>
        </div>
    </div>

    <hr class="about-separator">

    <!-- Administration Section -->
    <h2 class="team-section-title">Ingénierie & Développement</h2>
    <div class="admin-wrapper">
        <div class="card team-member-card">
            <div class="card-body member-info">
                <div class="team-image-wrapper led-container" id="portraitWrapper">
                    <canvas id="ledCanvas" class="led-canvas"></canvas>
                    <img src="{{ asset('images/developer/salim.png') }}" alt="EL BOURMAKI Salim"
                        onerror="this.src='https://ui-avatars.com/api/?name=Salim+EL+BOURMAKI&background=0284c7&color=fff'">
                </div>
                <h3 class="member-name">EL BOURMAKI Salim</h3>
                <div class="member-social-links">
                    <a href="https://github.com/salimelbourmaki" target="_blank" class="social-icon github" title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/salim-el-bourmaki-885304373" target="_blank" class="social-icon linkedin" title="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
                <a href="mailto:salimelbourmaki1@gmail.com" class="btn btn-outline btn-contact led-container" id="contactBtnWrapper">
                    <canvas id="contactLedCanvas" class="led-canvas"></canvas>
                    <i class="far fa-envelope"></i> Contacter Salim
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/about.js'])
    @endpush
@endsection
