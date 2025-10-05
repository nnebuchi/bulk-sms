<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'verification_code', 'verified_expiry_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function contacts(){
        return $this->hasMany(Contact::class)->orderBy('title', 'Asc');
    }

    // public function schedules(){
    //     return $this->hasMany(Message::class)->where('user_id', Auth::user()->id);
    // }

    /**
     * Get the scheduled messages for the user.
     * NOTE: I've removed the Auth::user()->id dependency here, models shouldn't rely on global auth state.
     */
    public function schedules()
    {
        return $this->messages()->whereNotNull('sent_at'); // Assuming a scheduled message has a future or null sent_at
    }

    public function units(){
        return $this->hasMany(UnitPurchase::class);
    }

    function messages(){
        return $this->hasMany(Message::class);
    }

    /**
     * Get the API keys associated with the user. (New Relationship)
     */
    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    /**
     * Calculate the current available SMS units. (New method based on your logic)
     *
     * @return float
     */
    public function getAvailableUnitsAttribute(): float
    {
        // Calculate the sum of available_units from the related UnitPurchase models
        return (float) $this->units()->sum('available_units');
    }
}
