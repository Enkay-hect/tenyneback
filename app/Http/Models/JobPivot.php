<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;



class JobPivot extends Pivot
{
    use HasFactory;

    public function jobrole() {

        return $this->belongsTo(JobRole::class, 'id');
      }

      public function jobrolecategory() {

          return $this->belongsTo(JobRoleCategory::class, 'id');
      }
}
