<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class TicketController extends Controller
{
    public function show($id)
    {
        // Fetch event details with its dates
        $event = Event::with('eventDates')->findOrFail($id);

        return view('tickets', compact('event'));
    }
}
