<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping_Country extends Model
{
    protected $table = "shipping_countries";
    protected $fillable = ["shipping_country_id","country","zone_id"];
    protected $primaryKey = "shipping_country_id";

    public $timestamps = false;
    public $incrementing = false;
}
