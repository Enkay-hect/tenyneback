<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class FaqProgramPivot extends Pivot
{
    use HasFactory;

    public function faq() {

        return $this->belongsTo(Faq::class, 'id');
      }

      public function program() {

          return $this->belongsTo(Programs::class, 'id');
      }
}
