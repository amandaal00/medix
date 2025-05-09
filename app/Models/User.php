<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'name',
        'email',
        'birth_date',
        'phone',
        'blood_type',
        'rm',
        'role',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function checkups(){
        return $this->hasMany(Checkup::class);
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'phone' => $this->phone,
            'blood_type' => $this->blood_type,
            'rm' => $this->rm,
            'address' => $this->address,
        ];
    }

    public function accessRequests()
    {
        return $this->hasMany(MedicalAccessRequest::class, 'patient_id');
    }
}
