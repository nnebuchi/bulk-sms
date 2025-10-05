<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    protected $fillable = [
    'message_id', 'contact_id', 'status', 'gateway_ref', 'sent', 'failed'
    ];

    public $table = 'contact_message';

     public function message(){
        return $this->belongsTo(Message::class);
    }

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
}
