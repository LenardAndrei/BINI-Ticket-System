<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'seat_number', 'is_reserved'];

    public function section()
    {
        return $this->belongsTo(TicketSection::class);
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
}
