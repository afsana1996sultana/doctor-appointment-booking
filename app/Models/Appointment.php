<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id','patient_id', 'date', 'time_slot', 'status'];

    public function doctorAvailabilities()
    {
        return $this->belongsTo(DoctorAvailabilities::class, 'doctor_id', 'id');
    }
}
