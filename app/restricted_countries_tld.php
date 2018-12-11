<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class restricted_countries_tld extends Model
{
    protected $table = 'restricted_countries_tld';
    protected $fillable = ['country_id','tld_id'];
}
