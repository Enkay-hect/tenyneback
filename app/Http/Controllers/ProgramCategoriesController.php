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

        return response()->json([
            'programs' => $data,

        ]);
    }

    public function getprogramcategory(){
        $data = ProgramCategories::all();

        return response()->json([
            'programcategory' => $data
        ]);
    }


    public function updateprogramcategory(Request $request, $id)
    {

        $data = Validator::make($request->all(), [
            'title' => 'required|string',

        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundCategory = ProgramCategories::find($id);

        if (!$foundCategory) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundCategory->update([
            'title' => $request->input('title'),
        ]);


        return response()->json(['message' => 'Category updated successfully']);

    }


    public function deleteprogramcategory($id){
        $foundCat = ProgramCategories::where(['id' => $id])->first();

        if (!$foundCat) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundCat->instructors()->detach();

        $foundCat->delete();

        return response()->json(['message' => 'Category deleted']);
    }  
    


}




