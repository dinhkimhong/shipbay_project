<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $fillable = ["role"];
    protected $primaryKey = "role_id";

    public $timestamp = false;
    public $incrementing = false;

    public function users(){
    	return $this->belongsToMany(User::class);
    }
}
