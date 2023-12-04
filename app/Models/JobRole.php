<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Js;

class JobRole extends Model
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

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        return asset('storage/images/' . $this->image);
    }

    public function jobRoleCategories():BelongsToMany
     {
        return $this->belongsToMany(
            JobRoleCategory::class,
            'job_pivot',
            'job_role_id',
            'job_category_id',
        );
    }


    public function plan(): BelongsToMany
    {
        return $this->BelongsToMany(
            Plans::class,
            'plan_role_pivot',
    'role_id',
    'plan_id'
        )->withTimestamps();
    }


}
