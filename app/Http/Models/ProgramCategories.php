<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProgramCategories extends Model
{
    use HasFactory;

         /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'title',
    ];

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(
            Programs::class,
            'program_categories_pivot',
            'program_categories_id',
            'programs_id'
        )->withTimestamps();
    }
}
