<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules'; 
    protected $fillable = [
        'user_id',
        'doctor_id',
        'date',
        'start_time',
        'end_time'
    ];
    protected $primaryKey = 'id';
    protected $ForeignKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
