<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class faqController extends Controller
{
    public function createfaq(Request $request){
        $data = Validator::make($request->all(), [
                "question"  => "string",
                "answer"    => "string",
                "type"      => "string",
        ]);

        if($data->fails()){
            return response()->json([
                "message"=> $data->errors(),
            ], 400);   
        }


        $data = $request->post();
        $this->create($data);
    }

    public function create(array $data){
        Faq::create([
            "question"=> $data["question"],
            "answer"=> $data["answer"],
            "type"=> $data["type"],
        ]);
    }




    public function updatefaq(Request $request, $id){
        $data = Faq::make($request->all(), [
            'question'              => 'string',
            'answer'                => 'string',
            'type'                  => 'string'
        ]);

        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }

        $foundFaq = Faq::find($id);

        if (!$foundFaq) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundFaq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'type' => $request->input('type'),

        ]);


        return response()->json(['message' => 'Updated successfully']);
    }


    public function deletefaq($id){
        $foundFaq = Faq::where(['id' => $id])->first();

        if (!$foundFaq) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $foundFaq->delete();

        return response()->json(['message' => 'role deleted']);

    }




    public function getfaq(){
        $data = Faq::all();


        if ($data->isEmpty()) {
            return response()->json(['message' => 'No instructors found'], 404);
        }

        return response()->json([
            'faq' => $data
        ]);
    }

}



