<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $table = "carriers";
    protected $fillable = ["carrier","carrier_name"];
    protected $primaryKey = "carrier";

    public $timestamps = false;
    public $incrementing = false;
}
