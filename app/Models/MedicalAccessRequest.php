<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAccessRequest extends Model
{
    use HasFactory;
    
    protected $table = 'medical_access_requests';
    protected $fillable = ['patient_id', 'doctor_id', 'status', 'expires_at'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}

