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

    <div class="member-id">
        <p>Member ID</p>
        <input type="text" name="member-id" placeholder="" >
    </div>

<form action="{{ route('cart.add') }}" method="POST">
    @csrf

    <div class="dropdown-section">

        <!-- Event Date -->
        <div class="dropdown">
            <button type="button" onclick="toggleDropdown(this)" class="dropbtn">Select Date</button>
            <div class="dropdown-content">
                @foreach ($event->eventDates as $date)
                    <a href="#" class="dropdown-item"
                       data-type="date"
                       data-value="{{ $date->id }}">
                        {{ \Carbon\Carbon::parse($date->date)->format('F j, Y') }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Ticket Type -->
<div class="dropdown">
  <button type="button" onclick="toggleDropdown(this)" class="dropbtn">Ticket Types</button>
  <div class="dropdown-content" id="ticketTypes">
    @foreach ($event->ticketTypes as $type)
      <a href="#" class="dropdown-item"
        data-type="ticket_type"
        data-value="{{ $type->id }}"
        data-price="{{ $type->price }}">
        {{ $type->type_name }}
      </a>
    @endforeach
  </div>
</div>

<!-- Section -->
<div class="dropdown">
  <button type="button" onclick="toggleDropdown(this)" class="dropbtn">Select Section</button>
  <div class="dropdown-content" id="sections">
    @foreach ($event->ticketTypes as $type)
      @foreach ($type->sections as $section)
        <a href="#" class="dropdown-item section-item"
           data-type="section"
           data-value="{{ $section->id }}"
           data-ticket-type="{{ $type->id }}">
           {{ $section->section_label }}
        </a>
      @endforeach
    @endforeach
  </div>
</div>

<!-- Seat -->
<div class="dropdown">
  <button type="button" onclick="toggleDropdown(this)" class="dropbtn">Select Seat</button>
  <div class="dropdown-content" id="seats">
    @foreach ($event->ticketTypes as $type)
      @foreach ($type->sections as $section)
        @foreach ($section->seats as $seat)
          @if (!$seat->is_reserved)
            <a href="#" class="dropdown-item seat-item"
               data-type="seat"
               data-value="{{ $seat->id }}"
               data-section-id="{{ $section->id }}">
               Seat {{ $seat->seat_number }}
            </a>
          @endif
        @endforeach
      @endforeach
    @endforeach
  </div>
</div>


    <!-- Hidden inputs to hold the selected values -->
    <input type="hidden" name="event_id" value="{{ $event->id }}">
    <input type="hidden" name="date_id" id="selectedDate">
    <input type="hidden" name="ticket_type" id="selectedType">
    <input type="hidden" name="section" id="selectedSection">
    <input type="hidden" name="seat_number" id="selectedSeat">
    <input type="hidden" name="price" id="selectedPrice">

    <div class="add-cart-button">
        <button type="submit">Add to Cart</button>
    </div>
</form>


    <div class="ticket-cart">
        <h1>Ticket Cart</h1>

        @if (session('cart') && count(session('cart')) > 0)
            <table>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Section</th>
                    <th>Seat</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                @foreach (session('cart') as $id => $item)
                    <tr>
                        <td>{{ $item['date_name'] ?? 'N/A' }}</td>
                        <td>{{ $item['ticket_type_name'] }}</td>
                        <td>{{ $item['section_label']  ?? 'N/A'}}</td>
                        <td>{{ $item['seat_number'] ?? 'N/A' }}</td>
                        <td>₱{{ number_format($item['price'] ?? 0) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="remove">
                                    <button type="submit">Remove</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="checkout">
                <a href="{{ route('checkout') }}">
                    <button>Proceed to Checkout</button>
                </a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
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
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const type = this.dataset.type;
            const value = this.dataset.value;

            // Save selected value in hidden input
            if (type === 'date') document.getElementById('selectedDate').value = value;
            if (type === 'ticket_type') {
                document.getElementById('selectedType').value = value;
                document.getElementById('selectedPrice').value = this.dataset.price || 0;
                }
            if (type === 'section') document.getElementById('selectedSection').value = value;
            if (type === 'seat') document.getElementById('selectedSeat').value = value;

            // Visually show selection
            this.closest('.dropdown').querySelector('.dropbtn').textContent = this.textContent;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    const ticketTypeInput = document.getElementById('selectedType');
    const sectionInput = document.getElementById('selectedSection');

    // When user selects ticket type, show only matching sections
    document.querySelectorAll('.dropdown-item[data-type="ticket_type"]').forEach(item => {
        item.addEventListener('click', function() {
            const selectedTypeId = this.dataset.value;
            ticketTypeInput.value = selectedTypeId;

            document.querySelectorAll('.section-item').forEach(section => {
                section.style.display = section.dataset.ticketType === selectedTypeId ? 'block' : 'none';
            });

            // Reset sections & seats dropdown labels
            document.getElementById('selectedSection').value = '';
            document.getElementById('selectedSeat').value = '';
            document.querySelector('#sections').previousElementSibling.textContent = 'Select Section';
            document.querySelector('#seats').previousElementSibling.textContent = 'Select Seat';
        });
    });

    // When user selects section, show only matching seats
    document.querySelectorAll('.dropdown-item[data-type="section"]').forEach(item => {
        item.addEventListener('click', function() {
            const selectedSectionId = this.dataset.value;
            sectionInput.value = selectedSectionId;

            document.querySelectorAll('.seat-item').forEach(seat => {
                seat.style.display = seat.dataset.sectionId === selectedSectionId ? 'block' : 'none';
            });

            // Reset seat dropdown label
            document.getElementById('selectedSeat').value = '';
            document.querySelector('#seats').previousElementSibling.textContent = 'Select Seat';
        });
    });
});

    </script>


</body>
</html>
