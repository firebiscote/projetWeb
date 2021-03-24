<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'firstName', 'email', 'role', 'password', 'center_id', 'right_id',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function right() 
    {
        return $this->belongsTo(Right::class);
    }
    public function offers() 
    {
        return $this->belongsToMany(Offer::class);
    }
    public function center() 
    {
        return $this->belongsTo(Center::class);
    }
    public function promotions() 
    {
        return $this->belongsToMany(Promotion::class);
    }
    public function companies() 
    {
        return $this->belongsToMany(Company::class);
    }
    public function ratings() 
    {
        return $this->belongsToMany(Rating::class);
    }
}
