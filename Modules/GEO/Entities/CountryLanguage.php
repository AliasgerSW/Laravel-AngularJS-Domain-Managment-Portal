<?php

namespace Modules\GEO\Entities;

use Illuminate\Database\Eloquent\Model;

class CountryLanguage extends Model
{
    public  $timestamps = false;

    protected $fillable = [
        'country_id', 'language_id'
    ];

}
