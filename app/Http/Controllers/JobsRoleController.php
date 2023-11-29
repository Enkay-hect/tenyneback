<?php

namespace App\Http\Controllers;

use App\Models\jobRole;
use App\Models\jobRoleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsRoleController extends Controller
{
    public function createjobrole(Request $request){
        $data = Validator::make($request->all(),[
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
            $this->create($data,$fileName);

            return response()->json([
                'data' => $data,
                'file' => $fileName
            ],200);



    }

    public function create(array $data, $fileName){
        $findCategory = jobRoleCategory::where(['id' => $data['id']])->first();
        $findCategoryId = jobRoleCategory::find($findCategory)->first();

        $roles = jobRole::create([
            'role'  => $data['role'],
            'title' => $data['title'],
            'image' => $fileName,
        ]);

        $roles->jobRoleCategories()->attach($findCategoryId);

    }


    public function getjobrole()
    {
        $data = jobRole::with(['jobRoleCategories'])->get();

        return response()->json([
            'job_roles' => $data
        ]);
    }

        //                             'image'            => asset('storage/images/' . $programs->image),




    public function deletejobrole($id){
        // $data = $request->validate([
        //     'id' => 'required|exists:job_roles, id',
        // ]);

        $foundRole = jobRole::where(['id' => $id])->first();

        if (!$foundRole) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundRole->delete();

        return response()->json(['message' => 'role deleted']);

    }

}
