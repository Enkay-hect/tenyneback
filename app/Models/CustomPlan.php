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
         'role_id', 'plan_id'

    ];

    protected $appends = [
        'duration'
    ];


    public function getDurationAttribute(){
        $startdate  =   Carbon::parse($this->start_date);
        $enddate    =   Carbon::parse($this->end_date);

        return $enddate->diffInMonths($startdate);
    }

   
    
    
    // public function setStartDateAttribute($value)
    // {
    //     $this->attributes['start_date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
    // }

    // public function setEndDateAttribute($value)
    // {
    //     $this->attributes['end_date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
    // }


    public function roles(): BelongsToMany  
    {
        return $this->belongsToMany(
            JobRole::class,
            'customplan_role_pivot',
            'role_id',
            'plan_id'
        )->withTimestamps();
    }


    public function plans(): BelongsToMany  
    {
        return $this->belongsToMany(
            Plan::class,
            'customplan_role_pivot',
            'plan_id',
            'role_id',
            
        )->withTimestamps();
    }

    public function submission(): BelongsToMany  
    {
        return $this->belongsToMany(
            CustomPlan::class,
            'customplan_role_pivot',
            'submission_id',
            'id'
        )->withTimestamps();
    }
}



