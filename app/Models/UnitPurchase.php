<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPurchase extends Model
{
    function payments(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
