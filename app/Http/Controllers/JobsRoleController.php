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
        // $findCategoryId = jobRoleCategory::find($findCategory)->first();

        $roles = jobRole::create([
            'role'  => $data['role'],
            'title' => $data['title'],
            'image' => $fileName,
        ]);

        $roles->jobRoleCategories()->attach($findCategory);

    }


    public function getjobrole()
    {
        $data = jobRole::with(['jobRoleCategories'])->get();

        $roleData = $data->map(function($role){

            return [
                'job_roles' => $role,
                'imageUrl' => asset('storage/images/' . $role->image)
            ];

        });

        return response()->json([
             'job_role' => $roleData,

        ]);
    }


    public function updatejobrole(Request $request, $id)
    {
            $data = Validator::make($request->all(), [
                'role' => 'required|string',
                'title' => 'sometimes|string',
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()], 422);
            }

            $foundRole = jobRole::find($id);

            if (!$foundRole) {
                return response()->json(['error' => 'Not found'], 404);
            }

            $foundRole->update([
                'role' => $request->input('role'),
                'title' => $request->input('title'),
            ]);


            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/images', $fileName);

                $foundRole->update(['image' => $fileName]);
            }

            return response()->json(['message' => 'Role updated successfully']);
    }



    public function deletejobrole($id)
    {
        $foundRole = jobRole::where(['id' => $id])->first();

        if (!$foundRole) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $foundRole->jobRoleCategories()->detach();

        $foundRole->delete();

        return response()->json(['message' => 'role deleted']);

    }

}
