<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CustomPlan extends Model
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

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }


    public function role(): BelongsToMany  
    {
        return $this->belongsToMany(
            JobRole::class,
            'customplan_role_pivot',
            'customplan_id',
            'role_id',
        )->withTimestamps();
    }
}
