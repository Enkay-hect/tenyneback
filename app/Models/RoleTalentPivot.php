<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleTalentPivot extends Pivot
{
    use HasFactory;

    public function role() {
        return $this->belongsTo(JobRole::class, 'id');
      }

      public function talentpipeline() {
          return $this->belongsTo(Talentpipeline::class, 'id');
      }

      public function plan() {
        return $this->belongsTo(Plan::class, 'id');
    }
}
