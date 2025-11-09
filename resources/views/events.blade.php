<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="event-header">
        <div class="exclusive-membership">
            <button>Exclusive Membership</button>
        </div>

        <div class="search-bar">
            <input type="search" id="search-input" name="query" placeholder="Search...">
        </div>
    </div>

    <div class="nav-bar">
        <div class="incoming-events tab active-tab" onclick="showSection('upcoming')">
            <h1>Incoming Events</h1>
        </div>
        <div class="past-events tab" onclick="showSection('past')">
            <h1>Past Events</h1>
        </div>
    </div>

    <div id="upcoming-section" class="event-section">
        @if($upcoming->isEmpty())
            <p>No upcoming events available.</p>
        @else
            <div class="event-list">
                @foreach($upcoming as $event)
                    <div class="event-card">
                        <h3>{{ $event->event_name }}</h3>
                        <p>{{ $event->location }}</p>

                        @foreach($event->eventDates as $date)
                            <p>{{ \Carbon\Carbon::parse($date->event_date)->format('F j, Y') }}</p>
                        @endforeach

                        <a href="{{ route('tickets.show', $event->id) }}">
                            <button>Buy Ticket</button>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="past-section" class="event-section" style="display: none;">
        @if($past->isEmpty())
            <p>No past events yet.</p>
        @else
            <div class="event-list">
                @foreach($past as $event)
                    <div class="event-card past">
                        <h3>{{ $event->event_name }}</h3>
                        <p>{{ $event->location }}</p>
                        @foreach($event->eventDates as $date)
                            <p>{{ \Carbon\Carbon::parse($date->event_date)->format('F j, Y') }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <img src="{{ asset('images/bini-logo.jpg') }}" alt="BINI Logo" class="logo-decoration">

    <script>
        function showSection(section) {
            const upcoming = document.getElementById('upcoming-section');
            const past = document.getElementById('past-section');
            const tabs = document.querySelectorAll('.tab');

            // Hide both sections first
            upcoming.style.display = 'none';
            past.style.display = 'none';

            // Remove active tab styling
            tabs.forEach(tab => tab.classList.remove('active-tab'));

            // Show the selected section
            if (section === 'upcoming') {
                upcoming.style.display = 'block';
                document.querySelector('.incoming-events').classList.add('active-tab');
            } else {
                past.style.display = 'block';
                document.querySelector('.past-events').classList.add('active-tab');
            }
        }
    </script>
</body>
</html>
