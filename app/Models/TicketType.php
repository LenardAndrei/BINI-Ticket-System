<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'type_name', 'price', 'has_seats'];
    public $timestamps = false;

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function sections()
    {
        return $this->hasMany(TicketSection::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
