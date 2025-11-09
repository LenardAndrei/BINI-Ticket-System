<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSeat extends Model
{
    use HasFactory;
    protected $fillable = ['ticket_id', 'seat_number', 'status'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

