<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "states";
    protected $fillable=["state","country_id","state_id"];
    protected $primaryKey = "state_id";

    public $timestamps = false;
    public $incrementing = false;
}
