<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedRoom extends Model
{
    use HasFactory;
    protected $fillable=['order_id','room_id','booked_date'];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
