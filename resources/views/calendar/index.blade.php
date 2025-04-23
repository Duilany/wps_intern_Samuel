@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h3>Dashboard Kalender Log Harian</h3>
    <div id="calendar"></div>
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
                height: 600
            });
            calendar.render();
        });
    </script>
@endsection
