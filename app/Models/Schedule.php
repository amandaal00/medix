<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Schedule extends Model
{
    use Searchable;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function poly(){
        return $this->belongsTo(Poly::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'day' => $this->day,
            'start' => $this->start,
            'finish' => $this->finish,
        ];
    }

    public function hari(){
        if($this->day == 'monday') return 'Senin';
        if($this->day == 'tuesday') return 'Selasa';
        if($this->day == 'wednesday') return 'Rabu';
        if($this->day == 'thursday') return 'Kamis';
        if($this->day == 'friday') return 'Jumat';
        if($this->day == 'saturday') return 'Sabtu';
        if($this->day == 'sunday') return 'Minggu';
    }
}
