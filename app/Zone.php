<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = "zones";
    protected $fillable = ["zone_id","zone"];
    protected $primaryKey = "zone_id";

    public $timestamps = false;
    public $incrementing = false;
}
