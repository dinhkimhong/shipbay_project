<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $table = "estimates";
    protected $fillable = ["contact","sender_name","sender_address","sender_city","sender_state","sender_country","sender_postal_code","sender_tel","shipping_address","city","province","shipping_country","postal_code","tel","length","width","height","weight","total_amount","shipping_cost","tracking_code","label_url","easypost_inhouse_shipment_id","note","created_by"];
    protected $primaryKey = "estimate_id";

    public $timestamps = false;

    public function address_2()
    {
        return $this->city. ", " .$this->province . ", " . $this->shipping_country . ", " . $this->postal_code;   	
    }
}
