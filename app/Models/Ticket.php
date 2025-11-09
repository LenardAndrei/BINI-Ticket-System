<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'ticket_type_id',
        'section_id',
        'seat_id',
        'customer_name',
        'customer_email',
        'quantity',
        'total_price',
        'purchase_date'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function section()
    {
        return $this->belongsTo(TicketSection::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
