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

                //programsCategories
                'title'            => 'string',


                //programs
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

                //instructor
                'instructor_name'       => 'string',
                'instructor_details'    => 'string',
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
        if($findProgramCategory = ProgramCategories::where(['title' => $data['title']])->first()){
            $findProgramCategoryId = ProgramCategories::find($findProgramCategory)->first();

            if($findProgram = Programs::where(['programTitle' => $data['programTitle']])->first()){
                $findProgramId = Programs::find($findProgram)->first();

                        $inst = ProgramInstructors::create([
                            'instructor_name'         => $data['instructor_name'],
                            'instructor_details'      => $data['instructor_details'],
                        ]);

                        $inst->Programs()->attach($findProgramId);

            } else {

                    [
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
                        ]),

                        $inst = ProgramInstructors::create([
                            'instructor_name'         => $data['instructor_name'],
                            'instructor_details'      => $data['instructor_details'],
                        ])
                    ];

                    $prog->ProgramCategories()->attach($findProgramCategoryId);
                    $inst->Programs()->attach($prog);
            }

        } else {
            [
                $cat =  ProgramCategories::create([
                        'title' => $data['title']
                ]),

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
                ]),

                $inst = ProgramInstructors::create([
                    'instructor_name'         => $data['instructor_name'],
                    'instructor_details'      => $data['instructor_details'],
                ])
            ];

            $cat->programs()->attach($prog);
            $inst->Programs()->attach($prog);

        }
    }

}
