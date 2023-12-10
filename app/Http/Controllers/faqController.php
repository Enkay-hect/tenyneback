<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class faqController extends Controller
{
    public function createFaq(Request $request){
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

}
