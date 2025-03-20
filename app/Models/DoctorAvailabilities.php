<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailabilities extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id','date', 'time_slot'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
