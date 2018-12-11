<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tld extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'sequence',
        'feature',
        'is_active_for_sale',
        'registrar',
        'cost_price',
        'min_purchase_limit',
        'max_purchase_limit',
        'min_renewal_limit',
        'max_renewal_limit',
        'max_cancellation_days',
        'min_renewal_time',
        'grace_period',
        'restore_period',
        'restore_price',
        'bulk_price_limit',
        'suggest_group',
        'transfer_price',
        'cancellation_fees',
        'renewal_price',
        'force_fully_active'
    ];

    protected $dates = ['deleted_at'];

    public function tldFeatureService()
    {
        return $this->hasOne(TldsFeaturesServices::class);
    }

    /**
     * Get Continents for the tld
     */
    public function continents()
    {
        return $this->belongsToMany('Modules\Domain\Entities\Continent', 'continent_tld')->withTimestamps();
    }

    /**
     * Get v for the tld
     */
    public function categoryTlds()
    {
        return $this->belongsToMany('Modules\Domain\Entities\CategoryTld', 'category_tld')->withTimestamps();
    }

    /**
     * Get Category Group for the tld
     */
    public function tldGroups()
    {
        return $this->belongsToMany('Modules\Domain\Entities\TldGroup', 'category_tld')->withTimestamps();
    }

    public function tldsRenewalPrices()
    {
        return $this->hasMany('Modules\Domain\Entities\TldsRenewalPrices');
    }

    public function tldsPrices()
    {
        return $this->hasMany('Modules\Domain\Entities\TldsPrices');
    }

    public function getTldsFromResellerClubOnly($feature= "Both", $activeForSale = null)
    {
        $query = $this->where('registrar','ResellerClub');
        if ($feature != "Both") {
            $query = $query->where('feature',$feature);
        }
        if ($activeForSale != null)
        {
            $query = $query->where('is_active_for_sale', $activeForSale);
        }
        return $query->get();

    }

    public function getTldsFromOpenSRSOnly($feature = "both", $activeForSale = null)
    {
        $query = $this->where('registrar','OpenSRS');
        if ($feature != "Both") {
            $query = $query->where('feature',$feature);
        }
        if ($activeForSale != null)
        {
            $query = $query->where('is_active_for_sale', $activeForSale);
        }
        return $query->get();
    }

    public function getPopularTldsOnly($registrar = 'Both', $activeForSale = null)
    {
        $query = $this->where('feature','Popular');
        if ($registrar != "Both") {
            $query = $query->where('feature',$registrar);
        }
        if ($activeForSale != null)
        {
            $query = $query->where('is_active_for_sale', $activeForSale);
        }
        return $query->get();

    }

    public function getRegularTldsOnly($registrar = 'Both', $activeForSale = null)
    {
        $query = $this->where('feature','Regular');
        if ($registrar != "Both") {
            $query = $query->where('registrar',$registrar);
        }
        if ($activeForSale != null)
        {
            $query = $query->where('is_active_for_sale', $activeForSale);
        }
        return $query->get();

    }
}
