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
        $data = ProgramCategories::with(['programs'])->get();

        $formattedCategories = $data->map(function($programCategory){
            return  [
                        "id"=> $programCategory->id,
                        "name"=> $programCategory->title,
                        "created_at"=> $programCategory->created_at,
                        "updated_at" => $programCategory->updated_at,
                        'programs' => $programCategory->programs->map(function($programs){

                                return [
                                    'id'               => $programs->id,
                                    'programTitle'     => $programs->programTitle,
                                    'image'            => asset('storage/images/' . $programs->image),
                                    'rating'           => $programs->rating,
                                    'reviews'          => $programs->reviews,
                                    'subtitle'         => $programs->subtitle,
                                    'description'      => $programs->description,
                                    'features'         => $programs->features,
                                    'start_date'       => $programs->start_date,
                                    'end_date'         => $programs->end_date,
                                    'price'            => $programs->price,
                                    'learning_scheme'  => $programs->learning_scheme,
                                    'why'              => $programs->why,
                                    'prerequisite'     => $programs->prerequisite,
                                    'best_fit'         => $programs->best_fit,
                                    'program_flow'     => $programs->program_flow,

                                    // "pivot"=> [

                                    //     "program_id"=> $programs->pivot->programs_id,
                                    //     "program_categories_id"=> $programs->pivot->program_categories_id
                                    // ],

                                    'instructors' => $programs->instructors->map(function ($instructor) {
                                        return [
                                            'name' => $instructor->instructor_name,
                                            'details' => $instructor->instructor_details,
                                        ];
                                    }),

                                ];
                        })

            ];
        });


        return response([
            'program_categories' => $formattedCategories
        ]);
    }

}




