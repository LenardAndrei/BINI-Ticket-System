<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class CartController extends Controller
{
    // 🛒 Show Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // ➕ Add Ticket to Cart
    public function add(Request $request)
{
    $request->validate([
        'date_id' => 'required',
        'ticket_type' => 'required',
        'section' => 'required',
        'seat_number' => 'required',
        'price' => 'required|numeric',
    ]);

    // ✅ Fetch the actual data
    $date = \App\Models\EventDate::find($request->date_id);
    $ticketType = \App\Models\TicketType::find($request->ticket_type);
    $section = \App\Models\TicketSection::find($request->section);

    $isMember = !empty($request->member_id);
    $maxTickets = $isMember ? 4 : 2;

    $key = $request->seat_number . '_' . $request->date_id;

    if (isset($cart[$key])) {
        return back()->with('error', 'This seat is already in your cart.');
    }

    $cart = session()->get('cart', []);

    if (count($cart) >= $maxTickets) {
        return back()->with('error', 'You have reached the maximum number of tickets allowed.');
    }


    // ✅ Store both IDs and names
    $cart[$key] = [
        'date_id' => $request->date_id,
        'date_name' => $date ? \Carbon\Carbon::parse($date->date)->format('F j, Y') : 'N/A', // Store actual date
        'ticket_type_id' => $request->ticket_type,
        'ticket_type_name' => $ticketType ? $ticketType->type_name : 'N/A', // Store type name
        'section_id' => $request->section,
        'section_label' => $section ? $section->section_label: 'N/A', // Store section name
        'seat_number' => $request->seat_number,
        'price' => $request->price,
        'is_member' => $isMember,
    ];

    session()->put('cart', $cart);

    return back()->with('success', 'Ticket added to cart!');
}

    // ❌ Remove Ticket from Cart
    public function remove($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Ticket removed from cart.');
    }

    return back()->with('error', 'Item not found in cart.');
}
}
