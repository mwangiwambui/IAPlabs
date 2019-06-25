<?php

namespace App;

use App\Http\Controllers\CarController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Reviews extends Model
{
    public function reviews(){
        return $this->belongsTo(Cars::class);
    }
}
