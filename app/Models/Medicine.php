<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Medicine extends Model
{
    use Searchable;
    protected $guarded = [];

    public function details(){
        return $this->hasMany(Detail::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'unit' => $this->unit,
            'price' => $this->price,
        ];
    }
}
