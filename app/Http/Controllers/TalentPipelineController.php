<?php

namespace App\Http\Controllers;

use App\Models\JobRole;
use App\Models\Talentpipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TalentPipelineController extends Controller
{
    public function createpipeline(Request $request){
        $data =  Validator::make($request->all(), [
            'company'                   => 'string', 
            'contact'                   => 'string', 
            'email'                     => 'string', 
            'phone_number'              => 'string', 
            'role'                      => 'string', 
            'description'               => 'string',
            'number_of_hires'           => 'string',
            'start_date'                => 'string',
            'end_date'                  => 'string',
            'location'                  => 'string',
            'mode'                      => 'string',
            'budget'                    => 'string',
            'payment'                   => 'string',
            'additional_requirement'    => 'string',
        ]);

        if($data->fails()){
            return response()->json([
                'error'=> $data->errors(),
            ], 422);
        }

        $data = $request->post();
        $this->create($data);

        return response()->json([
            'message'=> 'saved successfully',
        ]);

    }

    public function create(array $data){
        $findRoldId = JobRole::where(['id' => $data['id']])->first();

         $tal =   Talentpipeline::create([
                'company'                   => $data['company'], 
                'contact'                   => $data['contact'], 
                'email'                     => $data['email'], 
                'phone_number'              => $data['phone_number'], 
                'role'                      => $data['role'], 
                'description'               => $data['description'],
                'number_of_hires'           => $data['number_of_hires'],
                'start_date'                => $data['start_date'],
                'end_date'                  => $data['end_date'],
                'location'                  => $data['location'],
                'mode'                      => $data['mode'],
                'budget'                    => $data['budget'],
                'payment'                   => $data['payment'],
                'additional_requirement'    => $data['additional_requirement'],
            ]);

            $tal->role()->attach($findRoldId);

    }




    public function gettalentpipeline(){
        $data = Talentpipeline::with(['role'])->get();

        return response()->json([
            'pipeline' =>    $data
        ]);
    }




    public function updatetalentpipeline(Request $request, $id){
        $data =  Validator::make($request->all(), [
            'company'                   => 'string', 
            'contact'                   => 'string', 
            'email'                     => 'string', 
            'phone_number'              => 'string', 
            'role'                      => 'string', 
            'description'               => 'string',
            'number_of_hires'           => 'string',
            'start_date'                => 'string',
            'end_date'                  => 'string',
            'location'                  => 'string',
            'mode'                      => 'string',
            'budget'                    => 'string',
            'payment'                   => 'string',
            'additional_requirement'    => 'string',
        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundTalent = Talentpipeline::find($id);

        if (!$foundTalent) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundTalent->update([
                'company'                   =>      $request->input('company'), 
                'contact'                   =>      $request->input('contact'), 
                'email'                     =>      $request->input('email'), 
                'phone_number'              =>      $request->input('phone_number'), 
                'role'                      =>      $request->input('role'), 
                'description'               =>      $request->input('description'),
                'number_of_hires'           =>      $request->input('number_of_hires'),
                'start_date'                =>      $request->input('start_date'),
                'end_date'                  =>      $request->input('end_date'),
                'location'                  =>      $request->input('location'),
                'mode'                      =>      $request->input('mode'),
                'budget'                    =>      $request->input('budget'),
                'payment'                   =>      $request->input('payment'),
                'additional_requirement'    =>      $request->input('additional_requirement'),
        ]);

    }




    public function deletetalentpipeline($id){

        $foundTalent = Talentpipeline::where(['id' => $id])->first();

        if (!$foundTalent) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundTalent->delete();

        return response()->json(['message' => 'Talent deleted']);

    }

}



