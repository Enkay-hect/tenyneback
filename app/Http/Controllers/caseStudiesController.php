<?php

namespace App\Http\Controllers;

use App\Models\caseStudy;
use Illuminate\Http\Request;

class caseStudiesController extends Controller
{
    public function createCaseStudy(Request $request){
       $request->validate([
                'title' => 'required',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);



        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $fileName);


        $data = $request->post();
        $createData = $this->create($data, $fileName);


        return response([
            'data' => $createData,
        ]);
    }


    public function create(array $data, $fileName)
    {
        return caseStudy::create([
            'title' => $data['title'],
            'description'  => $data['description'],
            'image'     => $fileName,
        ]);
    }



    public function getcasestudy(){
        $data = caseStudy::all();
        return  response()->json([$data]);
    }
}
