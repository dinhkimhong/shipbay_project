<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = "titles";
    protected $fillable = ["title","title_id"];
    protected $primaryKey = "title_id";

    public $timestamps = false;
    public $incrementing = false;
}
