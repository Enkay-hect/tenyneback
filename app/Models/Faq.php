<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faq extends Model
{
    use HasFactory;

       /**
     * Write code on Method
     *
     * @return response()
     */

     protected $fillable = [
        'question',
        'answer',
        'type',
    ];


    public function program(): BelongsToMany
    {
        return $this->belongsToMany(
            Programs::class,
            'faq_program_pivot',
            'faq_id',
            'program_id',
        )->withTimestamps();

    }
}
