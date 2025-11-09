<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Fetch events with their dates
        $upcoming = Event::with('eventDates')
                        ->where('status', 'Upcoming')
                        ->orderBy('id', 'asc') // optional, or by name
                        ->get();

        $past = Event::with('eventDates')
                     ->where('status', 'Completed')
                     ->orderBy('id', 'desc')
                     ->get();

        return view('events', compact('upcoming', 'past'));
    }

    public function show($id)
    {
        $event = Event::with([
            'eventDates',
            'ticketTypes.sections.seats'
        ])->findOrFail($id);

        return view('tickets', compact('event'));
    }

}
