<?php

namespace App\Http\Controllers;

use App\Models\jobPivot;
use App\Models\jobRole;
use App\Models\jobRoleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class jobRolesCategoryController extends Controller
{
    public function createJobCategory(Request $request){

        $data = Validator::make($request->all(),[
            'name' => 'string|required',
            'role' => 'string|required',
            'title' => 'string|sometimes',
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
            'file' => $fileName
        ],200);

    }




    public function create(array $data, $fileName)
    {
        if ($findCategory = jobRoleCategory::where(['name' => $data['name']])->first()) {

            $findCategoryId = jobRoleCategory::find($findCategory)->first();

                $cat = jobRole::create([
                    'role'  => $data['role'],
                    'title' => $data['title'],
                    'image' => $fileName,
                ]);

            $cat->jobRoleCategories()->attach($findCategoryId);

        }
        else {
                [
                $cat =  jobRoleCategory::create([
                        'name'  => $data['name'],
                    ]),

                 $role =   jobRole::create([
                        'role'  => $data['role'],
                        'title' => $data['title'],
                        'image' => $fileName

                        //->getClientOriginalExtension(),

                    ])
                ];

              $cat->jobRoles()->attach($role);
        }

    }



   public function getjobcategory()
        {
            $data = jobRoleCategory::with(['jobRoles'])->get();

            $formattedCategories = $data->map(function ($jobCategory){
                return [

                        "id"=> $jobCategory->id,
                        "name"=> $jobCategory->name,
                        "created_at"=> $jobCategory->created_at,
                        "updated_at" => $jobCategory->updated_at,
                        "job_roles" => $jobCategory->jobRoles->map(function ($jobRole) {
                            return [

                                "id"=> $jobRole->id,
                                "title" => $jobRole->title,
                                "image"=> asset('storage/images/' . $jobRole->image),
                                "created_at"=> $jobRole->created_at,
                                "updated_at"=> $jobRole->updated_at,

                                "pivot"=> [

                                    "job_category_id"=> $jobRole->pivot->job_category_id,
                                    "job_role_id"=> $jobRole->pivot->job_role_id
                                ]

                            ];
                    })
                ];
            });

            return response()->json([
                'categories' => $formattedCategories
            ]);

            //with('job_role_categories');
            //    return  response()->json([
            //    "categories" =>  $data,
            // //    'image' => asset('storage/' . $data->image)

            // ]);
        }



}


// "categories": [
//     {
//         "id"=> $jobCategory->id,
//         "name"=> $jobCategory->name,
//         "created_at"=> $jobCategory->created_at,
//         "updated_at" => $jobCategory->updated_at,
//         "job_roles": [
//             {
//                 "id"=> $jobCategory->id,
//                 "title"=> $jobCategory->title,
//                 "image"=> asset('storage/images/' . $jobCategory->image),
//                 "created_at"=> $jobCategory->created_at,
//                 "updated_at"=> $jobCategory->updated_at,
//                 "pivot": {
//                     "job_category_id"=> $jobCategory->1,
//                     "job_role_id"=> $jobCategory->1
//                 }
//             }
//         ]
//     }
// ]
