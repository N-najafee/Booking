<?php

namespace App\Models;

use App\Http\constants\Constants;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'transaction_no', 'payment_type', 'paid_amount', 'booking_date', 'status'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function status():Attribute
    {
        return Attribute::get(function ($value){
            return $value === Constants::ORDER_SUCCESSFUL  ? "موفق" : "ناموفق";
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
