<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TldsRenewalPrices extends Model
{
    use SoftDeletes;
    protected $fillable = ['tld_id', 'year', 'renewal_price', 'promo_price', 'promo_from', 'promo_to'];

    public function tld()
    {
        return $this->belongsTo('Modules\Domain\Entities\Tld');
    }

}
