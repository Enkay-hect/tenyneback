<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Plans extends Model
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
        'annual_billing'
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function planFeature(): BelongsToMany
    {
        return $this->BelongsToMany(
            PlanFeature::class,
            'plan_feature_pivot',
    'plan_id',
    'plan_feature_id'
        )->withTimestamps();
    }

    public function role(): BelongsToMany
    {
        return $this->BelongsToMany(
            JobRole::class,
            'plan_role_pivot',
    'plan_id',
    'role_id'
        )->withTimestamps();
    }
}
