<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    protected $fillable = ['continent_id','tld_id'];

    /**
     * Get Tlds associated with the Continent
     */
    public function tlds()
    {
        return $this->belongsToMany('Modules\Domain\Entities\Tld');
    }
}
