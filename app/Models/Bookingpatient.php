<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookingpatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'booking_type',
        'appointment_date',
        'appointment_time',
    ];

     //Relation with patient user
     public function patient(){
        return $this->belongsTo(User::class, 'patient_id', 'id');

    }
    //Relation with doctor user
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id', 'id');

    }
}
