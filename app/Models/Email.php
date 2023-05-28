<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['subject','message', 'status','sent_at'];

    function getStatusAttribute($value)
    {
        return $value ? "ارسال نشده" : "ارسال شده";
    }
}
