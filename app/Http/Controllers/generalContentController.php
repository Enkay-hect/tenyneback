<?php

namespace App\Http\Controllers;

use App\Models\generalContents;
use Illuminate\Http\Request;

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
         return generalContents::create([
             'name'         => $inputs['name'],
             'description'  => $inputs['description'],
             'comment'      => $inputs['comment'],
         ]);
     }


   public function getcontent()
   {
       $data = generalContents::all();

        return  response()->json([$data]);


   }
}
