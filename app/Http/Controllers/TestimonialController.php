<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function createtestimonial(Request $request){
        $data = Validator::make($request->all(), [ 
                'name'          => 'required',
                'role'          => 'string',
                'description'   => 'string',
                'image'         => 'sometime|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
        
        $prog = Testimonial::create([
          'name'        => $data['name'],
          'role'        => $data['role'],
          'description' => $data['description'],
          'image'        =>  $fileName,

        ]);

    }
}
