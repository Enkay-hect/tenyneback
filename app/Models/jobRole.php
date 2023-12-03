<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class jobRole extends Model
{
    use HasFactory;

        /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'title',
        'image',
        'role'
    ];

    public function jobRoleCategories():BelongsToMany
     {
        return $this->belongsToMany(
            jobRoleCategory::class,
            'job_pivot',
            'job_role_id',
            'job_category_id',
        );
    }


}
