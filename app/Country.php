<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";
    protected $fillable = ["country","country_id"];

    protected $primaryKey = "country_id";

    public $timestamps = false;
    public $incrementing = false;
}
