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
                JobRoleCategory::create([
                        'name'  => $data['name'],
                ]);
    }


    public function updatejobcategory(Request $request, $id)
    {

        $data = Validator::make($request->all(), [
            'name' => 'required|string',

        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundRole = JobRoleCategory::find($id);

        if (!$foundRole) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundRole->update([
            'name' => $request->input('name'),
        ]);


        return response()->json(['message' => 'Category updated successfully']);

    }

    public function deletejobcategory($id)
    {
        $foundCategory = JobRoleCategory::where(['id' => $id])->first();

        if (!$foundCategory) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundCategory->jobRoles()->detach();
        $foundCategory->delete();

        return response()->json(['message' => 'Job category deleted successfully']);

    }

    public function getjobcategory(){
        $data = JobRoleCategory::with(['jobRoles'])->get();

        return response()->json([
            'job_roles_category' => $data
            //  'image'            => asset('storage/images/' . $programs->image),
        ]);
    }

}
