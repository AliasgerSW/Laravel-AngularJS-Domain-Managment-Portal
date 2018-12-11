<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TldsPrices extends Model
{
    use SoftDeletes;
    protected $fillable = ['tld_id', 'year', 'regular_price', 'promo_price', 'promo_from', 'promo_to', 'bulk_price'];

    public function tld()
    {
        return $this->belongsTo('Modules\Domain\Entities\Tld');
    }
}
