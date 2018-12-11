<?php

namespace Modules\GEO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
    protected $fillable = [
    	'name', 'iso_alpha_2_code', 'iso_alpha_3_code', 'iso_numeric_code', 'code', 'tld'
    ];

    /**
     * The language that belong to the country.
     */
    public function language()
    {
        return $this->belongsToMany(Language::class, 'country_languages', 'country_id', 'language_id');

    }

}
