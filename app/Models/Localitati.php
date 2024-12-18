<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localitati extends Model
{
    protected $fillable = ['codul','name','raion_id'];
    public $table = "localitati";

    public function raion(){
        return $this->belongsTo(Raion::class, 'raion_id', 'id');
    }
}
