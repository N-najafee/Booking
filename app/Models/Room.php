<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
protected $appends=['date'];
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function roomPhotos()
    {
        return $this->hasMany(RoomPhoto::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function bookedRooms()
    {
        return $this->hasMany(BookedRoom::class);
    }
}
