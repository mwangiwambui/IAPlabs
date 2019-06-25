<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable= ['make','model','product_on'];
    protected $primaryKey = 'id';

    public function cars(){
        return $this->hasMany(Reviews::class);
    }
}
