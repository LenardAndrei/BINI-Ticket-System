<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->event_name }} - Buy Tickets</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="back-button">
        <a href="{{ route('events') }}">
            <button> Back </button>
        </a>
    </div>

    <img src="{{ asset('images/binifiedSeat.png') }}" alt="BINIFIED" class="seating-plan">

    <div class="dropdown-section">

        <div class="dropdown">
            <button onclick="toggleDropdown(this)" class="dropbtn">Select Date</button>
            <div class="dropdown-content">
                @foreach ($event->eventDates as $date)
                    <a href="#"
                    data-date-id="{{ $date->id }}">
                    {{ \Carbon\Carbon::parse($date->date)->format('F j, Y') }}
                    </a>
                @endforeach
            </div>
        </div>


        <div class="dropdown">
            <button onclick="toggleDropdown(this)" class="dropbtn">Ticket Types</button>
            <div class="dropdown-content">
                @foreach ($event->eventDates as $date)
                    @foreach ($event->ticketTypes as $type)
                        <a href="#"
                        data-type-id="{{ $type->id }}">
                        {{ $type->name }} - ₱{{ number_format($type->price) }}
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>


        <div class="dropdown">
            <button onclick="toggleDropdown(this)" class="dropbtn">Select Section</button>
            <div class="dropdown-content">
                @foreach ($event->eventDates as $date)
                    @foreach ($event->ticketTypes as $type)
                        @foreach ($type->sections as $section)
                            <a href="#"
                            data-section-id="{{ $section->id }}">
                            {{ $section->name }}
                            </a>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>


        <div class="dropdown">
            <button onclick="toggleDropdown(this)" class="dropbtn">Select Seat</button>
            <div class="dropdown-content">
                @foreach ($event->eventDates as $date)
                    @foreach ($event->ticketTypes as $type)
                        @foreach ($type->sections as $section)
                            @foreach ($section->seats as $seat)
                                @if (!$seat->is_reserved)
                                    <a href="#"
                                    data-seat-id="{{ $seat->id }}">
                                    Seat {{ $seat->seat_number }}
                                    </a>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    <div class="ticket-cart">
        <h1> Ticket Cart</h1>
        <div class="cart-info">
            <div class="ticket-details">
                <p> Date:</p>
                <p> Ticket Type:</p>
                <p> Ticket Section:</p>
                <p> Ticket Seat:</p>
            </div>

            <div class="ticket-order">
                
            </div>
        </div>
    </div>

    <img src="{{ asset('images/bini-logo.jpg') }}" alt="BINI Logo" class="logo-decoration">


    <script>
        function toggleDropdown(button) {
        // Close all dropdowns first
        document.querySelectorAll('.dropdown-content').forEach(menu => {
            if (menu !== button.nextElementSibling) menu.classList.remove('show');
        });

        // Then toggle only the clicked one
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('show');
        }

        // Optional: Close dropdowns when clicking outside
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            document.querySelectorAll('.dropdown-content').forEach(menu => {
            menu.classList.remove('show');
            });
        }
        }
    </script>


</body>
</html>
