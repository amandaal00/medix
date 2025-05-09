<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRequest extends Model
{
    use HasFactory;

    // Tambahkan ini untuk mengizinkan mass assignment
    protected $fillable = [
        'patient_id', 
        'doctor_id',  
        'status'
    ];
}
