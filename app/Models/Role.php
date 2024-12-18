<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title'];
    public $table = 'roles';

    public function user(){
        return $this->belongsToMany(User::class, 'user_roles', 'role_id','user_id');
    }
}
