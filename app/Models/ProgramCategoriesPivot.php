<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramCategoriesPivot extends Pivot
{
    use HasFactory;

    public function programs() {

        return $this->belongsTo(Programs::class, 'id');
      }

      public function ProgramCategories() {

          return $this->belongsTo(ProgramCategories::class, 'id');
      }
}
