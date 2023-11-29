<?php

namespace App\Http\Controllers;

use App\Models\ProgramInstructors;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorsController extends Controller
{
    public function createinstructor(Request $request){

        $data = Validator::make($request->all(),[
            'instructor_name'       => 'string',
            'instructor_details'    => 'string',
        ]);


        if($data->fails()){
            return response()->json([
                "message" => $data->messages()
            ],400);
        }


        $data = $request->post();
        $this->create($data);


        return response()->json([
            'data' => $data,
        ],200);

    }

    public function create(array $data){
        $findProgram = Programs::where(['id' => $data['id']])->first();
        $findProgramId = Programs::find($findProgram)->first();

        $inst = ProgramInstructors::create([
            'instructor_name'         => $data['instructor_name'],
            'instructor_details'      => $data['instructor_details'],
        ]);

        $inst->Programs()->attach($findProgramId);

    }
}
