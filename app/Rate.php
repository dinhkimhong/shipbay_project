<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = "rates";
    protected $fillable = ["weight","zone_id","rate"];
    protected $primaryKey = "rate_id";

    public $timestamps = false;
}
