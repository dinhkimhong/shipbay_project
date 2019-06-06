<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate_Detail extends Model
{
    protected $table = "estimate_details";
    protected $fillable = ["estimate_id","category_id","item","quantity","price"];
    protected $primaryKey = "id";

    public $timestamps = false;
}
