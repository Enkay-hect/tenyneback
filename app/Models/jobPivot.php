<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;



class jobPivot extends Pivot
{
    use HasFactory;

    public function jobrole() {

        return $this->belongsTo(jobRole::class, 'id');
      }

      public function jobrolecategory() {

          return $this->belongsTo(jobRoleCategory::class, 'id');
      }
}
