<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Checkup extends Model
{
    use Searchable;

    protected $fillable = [
        'user_id', 'schedule_id', 'diagnosis', 'note', 'status', 
        'complaint', 'checkup_price', 'total_price'
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Schedule
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Relasi ke Detail (Banyak Detail dalam 1 Checkup)
     */
    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    /**
     * Konversi data untuk pencarian Laravel Scout
     */
    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'complaint' => $this->complaint,
        ];
    }

    /**
     * Menampilkan status checkup dalam format yang lebih mudah dipahami
     */
    public function checkup_status()
    {
        return match ($this->status) {
            'checkup' => 'Pemeriksaan',
            'waiting_medicine' => 'Menunggu Obat',
            'done' => 'Selesai',
            'canceled' => 'Dibatalkan',
            default => 'Status Tidak Diketahui'
        };
    }
}
