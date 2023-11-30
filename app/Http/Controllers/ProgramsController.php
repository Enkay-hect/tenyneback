<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategories;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramsController extends Controller
{
    public function createprogram(Request $request){

        $data = Validator::make($request->all(),[

            'programTitle'     => 'string',
            'image'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rating'           => 'string',
            'reviews'          => 'string',
            'subtitle'         => 'string|sometimes',
            'description'      => 'string|sometimes',
            'features'         => 'string',
            'start_date'       => 'string',
            'end_date'         => 'string',
            'price'            => 'string',
            'learning_scheme'  => 'string',
            'why'              => 'string|sometimes',
            'prerequisite'     => 'string',
            'best_fit'         => 'string',
            'program_flow'     => 'string',


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
            'file' => $fileName
        ],200);
    }




    public function create(array $data, $fileName){
        $findProgramCategory = ProgramCategories::where(['id' => $data['id']])->first();
        $findProgramCategoryId = ProgramCategories::find($findProgramCategory)->first();

        $prog = Programs::create([
            'programTitle'     => $data['programTitle'],
            'image'            => $fileName,
            'rating'           => $data['rating'],
            'reviews'          => $data['reviews'],
            'subtitle'         => $data['subtitle'],
            'description'      => $data['description'],
            'features'         => $data['features'],
            'start_date'       => $data['start_date'],
            'end_date'         => $data['end_date'],
            'price'            => $data['price'],
            'learning_scheme'  => $data['learning_scheme'],
            'why'              => $data['why'],
            'prerequisite'     => $data['prerequisite'],
            'best_fit'         => $data['best_fit'],
            'program_flow'     => $data['program_flow'],
        ]);

        $prog->ProgramCategories()->attach($findProgramCategoryId);
    }



    public function deleteprogram($id){
        $foundProgram = Programs::where(['id' => $id])->first();

        if (!$foundProgram) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $foundProgram->instructors()->detach();

        $foundProgram->delete();

        return response()->json(['message' => 'role deleted']);
    }
}
