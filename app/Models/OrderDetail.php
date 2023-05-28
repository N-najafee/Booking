<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'room_id', 'checkin_date', 'checkout_date', 'adult', 'children', 'subtotal'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
