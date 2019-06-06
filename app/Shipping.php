<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = "shippings";
    protected $fillable = ["estimate_id", "tracking_number","paid","stripe_charge_id","length","width","height","weight","shipping_cost","created_by","created_at"];
    protected $primaryKey = "shipping_id";

    public $timestamps = false;
}
