<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'phone',
        'departament_id',
    ];

    // protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function calendars()
    {
        return $this->belongsToMany(Calendar::class);
    }
    public function departaments()
    {
        return $this->belongsTo(Departament::class);
    }
    public function holidays()
    {
       return  $this->hasMany(Holiday::class);
    }
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
    public function departament()
    {
       return $this->belongsTo(Departament::class);
    }
    
}
