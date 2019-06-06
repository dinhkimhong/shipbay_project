<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $table = "trackers";
    protected $fillable = ["tracking_code","tracker_id"];
    protected $primaryKey = "tracking_code";

    public $timestamps = false;
    public $incrementing = false;
    
}
