<?php

namespace App\Http\Controllers;

use App\Models\jobRoleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class jobRolesCategoryController extends Controller
{
    public function createJobCategory(Request $request){

        $data = Validator::make($request->all(),[
            'name' => 'string|required',

        ]);

        if($data->fails()){
            return response()->json([
                "message" => $data->messages()
            ],400);
        }

        $data = $request->post();
        $this->create($data,);


        return response()->json([
            'data' => $data,
        ],200);

    }

    public function create(array $data)
    {
                jobRoleCategory::create([
                        'name'  => $data['name'],
                ]);
    }

}
