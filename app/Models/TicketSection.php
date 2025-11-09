<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSection extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_type_id', 'section_label'];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
