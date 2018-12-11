<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TldGroup extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    /**
     * Get Tlds belongs to the Category Group
     */
    public function tlds()
    {
        return $this->belongsToMany('Modules\Domain\Entities\Tld');
    }
}
