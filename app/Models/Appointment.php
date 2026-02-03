<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'schedule_id',
        'date',
        'time',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(DoctorProfile::class,'doctor_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class,'schedule_id', 'id');
    }



}
