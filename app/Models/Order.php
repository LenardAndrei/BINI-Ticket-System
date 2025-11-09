<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
    'user_id',
    'total_price',
    'payment_status',
    'payment_method', // optional but useful later
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seat()
    {
    return $this->belongsTo(TicketSeat::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
