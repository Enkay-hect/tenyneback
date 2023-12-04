<?php

namespace App\Http\Controllers;

use App\Models\GeneralContents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class generalContentController extends Controller
{
    public function createGeneralContent(Request $request){

        $request->validate([
                 'name' => 'required|string',
                 'description' => 'required|string',
                 'comment' => 'string'
             ]);


         $inputs = $request->post();
         $createData = $this->create($inputs);


         return response([
             'data' => $createData,
         ]);
     }

     public function create(array $inputs)
     {
         return GeneralContents::create([
             'name'         => $inputs['name'],
             'description'  => $inputs['description'],
             'comment'      => $inputs['comment'],
         ]);
     }


   public function getcontent()
   {
       $data = GeneralContents::all();

        return  response()->json([
            'content'=>$data
        ]);


   }



   public function updatecontent(Request $request, $id){
    $data = Validator::make($request->all(), [
                 'name' => 'required|string',
                 'description' => 'required|string',
                 'comment' => 'string'
    ]);

    if ($data->fails()) {
        return response()->json(['errors' => $data->errors()], 422);
    }

    $foundContent = GeneralContents::find($id);

    if (!$foundContent) {
        return response()->json(['error' => 'Not found'], 404);
    }

    $foundContent->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'comment' => $request->input('comment'),

    ]);

    return response()->json(['message' => 'Updated successfully']);


}



public function deletecontent($id){

    $foundContent = GeneralContents::where(['id' => $id])->first();

    if (!$foundContent) {
        return response()->json(['error' => 'Not found'], 404);
    }

        $foundContent->delete();

        return response()->json(['message' => 'Plan deleted']);

    }

}
