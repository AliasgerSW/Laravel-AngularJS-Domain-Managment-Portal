<?php

namespace Modules\GEO\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCode extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'post_code';

    protected $fillable = [
        'city_id', 'code'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
