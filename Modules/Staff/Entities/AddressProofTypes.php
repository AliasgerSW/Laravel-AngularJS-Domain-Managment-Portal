<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;

class AddressProofTypes extends Model
{
    protected $fillable = [
        'proof_name',
        'proof_descr',
        'accepted_at'
    ];

    protected $table = 'address_proof_types';
}
