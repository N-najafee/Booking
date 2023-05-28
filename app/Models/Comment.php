<?php

namespace App\Models;

use App\Http\constants\Constants;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['comment','status','room_id'];

    public function status():Attribute
    {
        return Attribute::get(function ($value){
            return $value === Constants::COMMENT_VERIFIED ? "تایید شده" : "تایید نشده";
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
