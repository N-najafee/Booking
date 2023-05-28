<?php

namespace App\Models;

use App\Http\constants\Constants;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=['title','photo','short_description','total_view','status','description'];


    public function status():Attribute
    {
        return Attribute:: get(function ($value){
            return $value === Constants::POST_ACTIVE ? "فعال" : "غیرفعال";
        });
    }
}
