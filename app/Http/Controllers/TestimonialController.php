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
                'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
        
        Testimonial::create([
          'name'        => $data['name'],
          'role'        => $data['role'],
          'description' => $data['description'],
          'image'        =>  $fileName,

        ]);

    }


    public function gettestimonial(){
        $data = Testimonial::all();

        return response()->json([
            'testimonials' => $data,
        ]);
    }


    public function updatetestimonial(Request $request, $id){

        $data = Validator::make($request->all(), [ 
            'name'          => 'required',
            'role'          => 'string',
            'description'   => 'string',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]   );
        
        if($data->fails()){
            return response()->json([
                'message'=> $data->messages()
            ], 422);
        }

        $foundTestimonial = Testimonial::find($id);

        if(!$foundTestimonial){
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundTestimonial->update([
            'name' => $request->input('name'),
            'role'=> $request->input('role'),
            'description'=> $request->input('description'),
        ]);

        if($request->hasFile('image')){
            $fileName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/images', $fileName);

            $foundTestimonial->update(['image'=> $fileName]);
        }

        return response()->json(['message' => 'Testimonial updated successfully']);

    }

    public function deletetestimonial($id){

        $foundTestimonial = Testimonial::where(['id' => $id])->first();

        if (!$foundTestimonial)
        {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundTestimonial->delete();

        return response()->json(['message' => 'Testimonial deleted']);

    }
}
