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
        'programTitle', 'image', 'rating', 'reviews', 'subtitle', 'description', 'features', 'start_date',
        'end_date', 'price', 'learning_scheme', 'why', 'prerequisite', 'best_fit', 'program_flow'
    ];

    protected $casts = [
        'features' => 'array',
        'learning-scheme' => 'array',
        'prerequisite' => 'array',
        'best_fit' => 'array',
        'program_flow' => 'array',
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        return asset('storage/images/' . $this->image);
    }


    public function ProgramCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProgramCategories::class,
            'program_categories_pivot',
    'programs_id',
    'program_categories_id',

        )->withTimestamps();

    }


    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(
            ProgramInstructors::class,
            'program_instructors_pivot',
    'programs_id',
    'program_instructors_id',

        )->withTimestamps();

        // ->using(ProgramInstructors::class)
    }
}
