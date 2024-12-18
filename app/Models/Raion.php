<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raion extends Model
{
    public $table="raions";
    protected $fillable = ['code', 'name'];

    public function localitati(){
        return $this->hasMany(Localitati::class, 'raion_id', 'id');
    }
}
