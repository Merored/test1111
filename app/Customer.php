<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'surname',
        'country', 
        'company', 
        'phone'
    ];     
}
