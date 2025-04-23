@extends('layouts.app')

@section('title', 'Dashboard Kalender')

@section('content')
    <h1>Dashboard Kalender</h1>
    <div id="calendar"></div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '{{ route('calendar.data') }}',
                eventClick: function(info) {
                    if (info.event.url) {
                        window.open(info.event.url);
                        info.jsEvent.preventDefault();
                    }
                }
            });
            calendar.render();
        });
    </script>
@endsection