<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // function contacts(){
    //  return $this->hasManyThrough(MessageContact::class, Contact::class);
    // }
    protected $fillable = ['user_id', 'type', 'title', 'content','status', 'sent_at','slug'];

    public function contacts(){
        return $this->belongsToMany(Contact::class);
    }

    public function messageStatus(){
        return $this->hasOne(StatusData::class, 'number', 'status');
    }

    public function schedule(){
        return $this->hasMany(MessageSchedule::class);
    }

}
