<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iban extends Model
{
    public $table = 'ibans';
    protected $fillable =['codul_eco','raion','localitatea','iban_code'];
}
