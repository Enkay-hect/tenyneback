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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        if($data->fails()){
            return response()->json([
                "message" => $data->messages()
            ],400);
        }
        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $fileName);


        $data = $request->post();
        $this->create($data, $fileName);


        return response()->json([
            'data' => $data,
            'file'  => $fileName
        ],200);

    }

    public function create(array $data, $fileName){
        
        $inst = ProgramInstructors::create([
            'instructor_name'         => $data['instructor_name'],
            'instructor_details'      => $data['instructor_details'],
            'image' => $fileName,

        ]);

        if(!empty($data['program_id'])){
            $findProgram = Programs::where(['id' => $data['id']])->first();
            $findProgramId = Programs::find($findProgram)->first();
            $inst->Programs()->attach($findProgramId);        }


    }


    public function updateinstructor(Request $request, $id){
        $data = Validator::make($request->all(), [
            'instructor_name'       => 'string',
            'instructor_details'    => 'string',
        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundInstructor = ProgramInstructors::find($id);

        if (!$foundInstructor) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundInstructor->update([
            'instructor_name' => $request->input('instructor_name'),
            'instructor_details' => $request->input('instructor_details'),
        ]);


        return response()->json(['message' => 'Updated successfully']);
    }


    public function deleteinstructor($id){
        $foundInstructor = ProgramInstructors::where(['id' => $id])->first();

        if (!$foundInstructor) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $foundInstructor->Programs()->detach();

        $foundInstructor->delete();

        return response()->json(['message' => 'Instructor deleted']);

    }


    public function getinstructor(){
        $data = ProgramInstructors::all();


        if ($data->isEmpty()) {
            return response()->json(['message' => 'No instructors found'], 404);
        }

        return response()->json([
            'instructors' => $data
        ]);
    }

}
