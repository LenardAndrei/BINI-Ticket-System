<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    public $timestamps = false;

    protected $fillable = [
        'event_name',
        'location',
        'status',
    ];

    public function eventDates()
    {
    return $this->hasMany(EventDate::class);
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }
}
