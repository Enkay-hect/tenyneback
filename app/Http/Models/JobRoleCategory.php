<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;



class JobRoleCategory extends Model
{
    use HasFactory;

        /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'name',
    ];

    public function jobRoles():BelongsToMany
    {
        return $this->belongsToMany(
            JobRole::class,
            'job_pivot',
            'job_category_id',
            'job_role_id',
        );
    }

}
