<?php

namespace App\Http\Controllers;

use App\Models\PlanFeature;
use App\Models\plans;
use Illuminate\Http\Request;


class plansController extends Controller
{
    public function createPlan(Request $request){

        $request->validate([
                 'plan_name'          => 'required',
                 'description'        => 'string',
                 'extra_details'      => 'string',
                 'billing_duration'   => 'required',
                 'price'              => 'required',
                 'features'           => 'required|string',
             ]);

         $data = $request->post();
         $this->create($data);

         return response([
             $data,
         ]);

     }


     public function create(array $data)
     {
        $plan = plans::create([
                        'plan_name'             => $data['plan_name'],
                        'extra_details'         => $data['extra_details'],
                        'billing_duration'      => $data['billing_duration'],
                        'price'                 => $data['price'],
                        'features'              => $data['features'],
                    ]);

                 PlanFeature::create([
                        'description'           => $data['description'],
                    ]);

                $plan->planFeature()->attach($plan);

     }




    public function addPlanFeature(Request $request){
        $data = (object) $request->only(['plan_name', 'feature', 'id']);


        if($details = plans::where(['plan_name' => $data->plan_name])->first()){
            $change = plans::find($details)->first();

            $features = collect($change->features);
            if(!$features->contains($data->feature)){
                    $features->add($data->feature);
                    $change->features = $features;
                    $change->save();
                     return response()->json([
                        'features' => $change->features
                    ],200);
            }

            return response(['plan feature already included']);


        }
    }


    public function getplan(){
        $data = plans::with(['planFeature'])->get();

        return  response()->json(
            ['plans' => $data]

        );

    }

}
