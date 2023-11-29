<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategories;
use App\Models\ProgramInstructors;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramCategoriesController extends Controller
{
        public function createprogramcategory(Request $request){

            $data = Validator::make($request->all(),[
                'title'            => 'string',

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
            ProgramCategories::create([
                        'title' => $data['title']
            ]);
    }



    public function getprogram(){
        $data = Programs::with(['ProgramCategories', 'instructors'])->get();

        return response([
            // 'program_categories' => $formattedCategories
            'programs' => $data
        ]);
    }

}




