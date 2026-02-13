@extends('layouts.app')

@section('title', 'Calendrier des Réservations')

@push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
    @vite(['resources/css/reservations/calendar.css'])
@endpush

@section('content')
<div class="calendar-container">
    <div class="page-header calendar-header">
        <div>
            <h1 class="page-title">Calendrier des <span>Réservations</span></h1>
            <p class="page-subtitle">Visualisez l'occupation des ressources en temps réel.</p>
        </div>
    </div>

    <div class="card calendar-card">
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>

{{-- Modal pour les détails de l'événement --}}
<div id="eventModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Détails de la réservation</h3>
            <button type="button" class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <p><strong>Ressource :</strong> <span id="eventResource"></span></p>
            <p><strong>Utilisateur :</strong> <span id="eventUser"></span></p>
            <p><strong>Début :</strong> <span id="eventStart"></span></p>
            <p><strong>Fin :</strong> <span id="eventEnd"></span></p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    @php
        $events = $reservations->map(function($res) {
            return [
                'title' => $res->resource->name . ' - ' . $res->user->name,
                'start' => $res->start_date->toIso8601String(),
                'end' => $res->end_date->toIso8601String(),
                'resource' => $res->resource->name,
                'user' => $res->user->name,
                'color' => $res->status === 'Active' ? '#22c55e' : '#3b82f6',
            ];
        });
    @endphp
    <script>
        window.calendarEvents = @json($events);
    </script>
    @vite(['resources/js/reservations/calendar.js'])
@endpush
