<?php

namespace App\Http\Controllers;

use App\Models\CaseStudies;
use App\Models\Models\CaseStudies as ModelsCaseStudies;
use App\Models\Test;
use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return CaseStudies::create([
            'title' => $data['title'],
            'description'  => $data['description'],
            'image'     => $fileName,
        ]);
    }



    public function getcasestudy(){


        $data = CaseStudies::all();
        dd($data);

        $formattedCasestudies = $data->map(function ($casestudy) {

            return [
                "id" => $casestudy->id,
                "image" => asset('storage/images/' . $casestudy->image),
                "title" => $casestudy->title,
                "description" => $casestudy->description,
                "created_at" => $casestudy->created_at,
                "updated_at" => $casestudy->updated_at
            ];
        });

        return response()->json([
            'casestudy' => $formattedCasestudies
        ]);

    }




    public function updatecasestudy(Request $request, $id){

        $data = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundCaseStudy = CaseStudies::find($id);

        if (!$foundCaseStudy) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundCaseStudy->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/images', $fileName);

            $foundCaseStudy->update(['image' => $fileName]);
        }


        return response()->json(['message' => 'Updated successfully']);

    }



    public function deletecasestudy($id){

        $foundCaseStudy = CaseStudies::where(['id' => $id])->first();

        if (!$foundCaseStudy)
        {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundCaseStudy->delete();

        return response()->json(['message' => 'role deleted']);

    }
}
