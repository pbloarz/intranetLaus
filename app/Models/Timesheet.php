<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'calendar_id',
        'day_in',
        'day_out',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}
