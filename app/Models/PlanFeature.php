<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class PlanFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'description',
    ];

    public function plans(): BelongsToMany
    {
        return $this->BelongsToMany(
            Plan::class,
            'plan_feature_pivot',
            'plan_feature_id',
            'plan_id'
        )->withTimestamps();
    }


}
