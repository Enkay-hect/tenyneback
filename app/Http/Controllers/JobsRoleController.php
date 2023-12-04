<?php

namespace App\Http\Controllers;

use App\Models\JobRole;
use App\Models\JobRoleCategory;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsRoleController extends Controller
{
    public function createjobrole(Request $request){
        $data = Validator::make($request->all(),[
            'role' => 'string|required',
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
        $findCategory = JobRoleCategory::where(['id' => $data['id']])->first();
        $findPlan = Plans::where(['id' => $data['id']])->first();

        // $findCategoryId = jobRoleCategory::find($findCategory)->first();

        $roles = JobRole::create([
            'role'  => $data['role'],
            'image' => $fileName,
        ]);

        $roles->jobRoleCategories()->attach($findCategory);
        $roles->plan()->attach($findPlan);

    }


    public function getjobrole()
    {
        $data = JobRole::with(['jobRoleCategories'])->get();

        // $roleData = $data->map(function($role){

        //     return [
        //         'job_roles' => $role,
        //         'image' => asset('storage/images/' . $role->image)
        //     ];

        // });

        return response()->json([
             'job_roles' => $data,

        ]);
    }


    public function updatejobrole(Request $request, $id)
    {
            $data = Validator::make($request->all(), [
                'role' => 'required|string',
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()], 422);
            }

            $foundRole = JobRole::find($id);

            if (!$foundRole) {
                return response()->json(['error' => 'Not found'], 404);
            }

            $foundRole->update([
                'role' => $request->input('role'),
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
        $foundRole = JobRole::where(['id' => $id])->first();

        if (!$foundRole) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $foundRole->jobRoleCategories()->detach();

        $foundRole->delete();

        return response()->json(['message' => 'role deleted']);

    }

}
