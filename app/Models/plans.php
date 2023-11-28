<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class plans extends Model
{
    use HasFactory;


      /**
     * Write code on Method
     *
     * @return response()
     */

     protected $fillable = [
        'plan_name',
        'price',
        'billing_duration',
        'extra_details',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function planFeature(): BelongsToMany
    {
        return $this->BelongsToMany(
            planFeature::class,
            'plan_feature_pivot',
    'plan_id',
    'plan_feature_id'
        )->withTimestamps();
    }
}
