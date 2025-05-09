<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Poly extends Model
{
    use Searchable;

    protected $guarded = [];
    
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
