<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";
    protected $fillable = ["contact","company","address","city","province","shipping_country_id","postal_code","tel","created_by"];
    protected $primaryKey = "contact_id";

    public $timestamps = false;


  	public function shipping_country()
  	{
  		return $this->hasOne(Shipping_Country::class,'shipping_country_id','shipping_country_id');
  	}

  	public function full_address(){
        return $this->address . ", " .$this->city. ", " .$this->province . ", " . $this->shipping_country->country . ", " . $this->postal_code;

  	}
}
