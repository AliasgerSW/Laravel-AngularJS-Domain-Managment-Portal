<?php

namespace Modules\GEO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'country_id', 'name', 'code'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
