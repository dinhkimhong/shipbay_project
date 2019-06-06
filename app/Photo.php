<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photos";
    protected $fillable = ["shipping_id","length_photo","width_photo","height_photo","weight_photo"];
    protected $primaryKey = "photo_id";

    public $timestamps = false;
}
