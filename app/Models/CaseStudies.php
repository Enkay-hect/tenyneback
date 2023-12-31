<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudies extends Model
{
    use HasFactory;

      /**
     * Write code on Method
     *
     * @return response()
     */

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute(){
        return asset('storage/images/' . $this->image);
    }
}
