<?php

namespace App\Http\Controllers;

use App\Models\PlanFeature;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class planFeaturesController extends Controller
{
   public function createPlanDescription(Request $request){


    $data = Validator::make($request->all(), [
        'description' => 'required|string'
    ]);

    $data = $request->post();
         $this->create($data);

         return response([
             $data,
         ]);

   }

   public function create(array $data){
    // $planId = Plans::where(['id' => $data['id']])->first();

        // $planDescription =
        PlanFeature::create([
            'description'  => $data['description']
        ]);

        // $planDescription->plans()->attach($planId);
   }

   public function getPlanFeatureDescription(){
    $data = PlanFeature::all();

    return response()->json([
        'features' => $data
    ]);

   }
}
