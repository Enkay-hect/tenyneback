<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class PlanFeaturePivot extends Pivot
{
    use HasFactory;

    public function plan() {
        return $this->belongsTo(plans::class, 'id');
      }

      public function planfeature() {
          return $this->belongsTo(PlanFeature::class, 'id');
      }
}
