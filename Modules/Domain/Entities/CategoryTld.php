<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTld extends Model
{
    protected $table = 'category_tld';
    protected $fillable = ['tld_group_id','tld_id'];


    /**
     * Get Tlds associated with the CategoryTld
     */
    public function tlds()
    {
        return $this->belongsToMany('Modules\Domain\Entities\Tld');
    }
}
