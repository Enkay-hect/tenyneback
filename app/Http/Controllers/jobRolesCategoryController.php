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
                        'image' => $fileName,

                    ])
                ];

              $cat->jobRoles()->attach($role);
        }

    }



   public function getjobcategory()
        {
            $data = jobRoleCategory::with(['jobRoles'])->get();

            //with('job_role_categories');
               return  response()->json([
               "categories" => $data
            ]);
        }



}
