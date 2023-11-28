<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramInstructorsPivot extends Pivot
{
    use HasFactory;

    public function programs() {

        return $this->belongsTo(Programs::class, 'id');
    }

    public function programinstructors() {

        return $this->belongsTo(ProgramInstructors::class, 'id');
    }

}
