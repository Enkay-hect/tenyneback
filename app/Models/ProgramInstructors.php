<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProgramInstructors extends Model
{
    use HasFactory;


            /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'name', 'details'
    ];


    public function Programs(): BelongsToMany
    {
        return $this->belongsToMany(
            Programs::class,
            'program_instructors_pivot',
            'program_instructors_id',
    'programs_id',

        );
    }

}
