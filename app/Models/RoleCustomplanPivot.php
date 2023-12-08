<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleCustomplanPivot extends Model
{
    use HasFactory;

    public function role() {
        return $this->belongsTo(JobRole::class, 'id');
      }

    public function customplan() {
        return $this->belongsTo(CustomPlan::class, 'id');
    }

    public function plan() {
        return $this->belongsTo(Plan::class, 'id');
    }
}
