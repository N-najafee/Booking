<?php

namespace App\Models;

use App\Http\constants\Constants;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable=['description','video_code','status'];
    public function status():Attribute
    {
        return Attribute:: get(function ($value){
            return $value === Constants::VIDEO_ACTIVE ? "فعال" : "غیرفعال";
        });
    }
}
