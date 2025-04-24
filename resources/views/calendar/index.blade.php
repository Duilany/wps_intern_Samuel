@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <style>
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">📅 Dashboard Kalender Log Harian</h3>
        <span class="badge bg-secondary">Direktur Utama</span>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route("calendar.data") }}',
                height: 600,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                eventDisplay: 'block',
                eventColor: '#0d6efd'
            });
            calendar.render();
        });
    </script>
@endsection
