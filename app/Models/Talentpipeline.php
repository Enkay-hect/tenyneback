<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talentpipeline extends Model
{
    use HasFactory;


         /**
     * Write code on Method
     *
     * @return response()
     */

     protected $fillable = [
        'company', 'contact', 'email', 'phone_number', 'role', 'description', 'number_of_hires',
         'start_date', 'end_date', 'location', 'mode', 'budget', 'payment', 'additional_requirement',

    ];

    protected $appends = [
        'duration'
    ];


    public function getDurationAttribute(){
        $startdate  =   Carbon::parse($this->start_date);
        $enddate    =   Carbon::parse($this->end_date);

        return $enddate->diffInMonths($startdate);
    }
}
