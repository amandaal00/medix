<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $guarded = [];

    public function checkup(){
        return $this->belongsTo(Checkup::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
