<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Programs extends Model
{
    use HasFactory;

            /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'title', 'image', 'rating', 'reviews', 'subtitle', 'description', 'features', 'start_date',
        'end_date', 'price', 'learning_scheme', 'why', 'prerequisite', 'best-fit', 'program_flow'
    ];

    protected $casts = [
        'features' => 'array',
        'learning-scheme' => 'array',
        'prerequisite' => 'array',
        'best_fit' => 'array',
        'program_flow' => 'array',
    ];


    public function ProgramCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProgramCategories::class,
            'program_categories_pivot',
    'programs_id',
    'program_categories_id',
        )->using(ProgramInstructors::class);
    }
}
