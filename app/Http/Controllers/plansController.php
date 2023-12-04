<?php

namespace App\Http\Controllers;

use App\Models\JobRole;
use App\Models\PlanFeature;
use App\Models\plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class plansController extends Controller
{
    public function createPlan(Request $request){


        $request->validate([
                 'plan_name'          => 'required',
                 'description'        => 'string',
                 'extra_details'      => 'string',
                 'billing_duration'   => 'required',
                 'price'              => 'required',
                 'annual_billing'     => 'string',
                 'features'           => 'string',
             ]);

         $data = $request->post();
         $this->create($data);

         return response([
             $data,
         ]);

     }


     public function create(array $data)
     {
        $findRoldId = JobRole::where(['id' => $data['id']])->first();

        $plan = Plans::create([
                        'plan_name'             => $data['plan_name'],
                        'extra_details'         => $data['extra_details'],
                        'billing_duration'      => $data['billing_duration'],
                        'price'                 => $data['price'],
                        'features'              => [$data['features']],
                        'annual_billing'        => $data['annual_billing']
                    ]);

        $plan->role()->attach($findRoldId);

     }


    public function addPlanFeature(Request $request, $id)
    {
        $data = (object) $request->only(['features']);

        if($details = Plans::find($id)){
            $change = Plans::find($details)->first();

            $features = collect($change->features);

            if(!$features->contains($data->features)){
                    $features->add($data->features);
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
        $data = Plans::with(['planFeature'])->get();

        return  response()->json(
            ['plans' => $data]

        );

    }


    public function updateplan(Request $request, $id){
        $data = Validator::make($request->all(), [
            'plan_name'          => 'required',
            'description'        => 'string',
            'extra_details'      => 'string',
            'billing_duration'   => 'required',
            'price'              => 'required',
            'features'           => 'required|string',
        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundPlan = Plans::find($id);

        if (!$foundPlan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundPlan->update([
            'plan_name' => $request->input('plan_name'),
            'description' => $request->input('description'),
            'extra_details' => $request->input('extra_details'),
            'billing_duration' => $request->input('billing_duration'),
            'price' => $request->input('price'),
            'features' => $request->input('features'),
        ]);

        return response()->json(['message' => 'Updated successfully']);


    }



    public function deleteplan($id){

        $foundPlan = Plans::where(['id' => $id])->first();

        if (!$foundPlan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundPlan->delete();

        return response()->json(['message' => 'Plan deleted']);

    }

}
