<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function showForm($id){
        $survey = DB::table('surveys')->where('unq_id',$id)->first();
        $survey_ques = DB::table('questions')->where('survey_unq_id',$id)->get();
        return view('user.survey_form',compact('survey_ques','survey'));
    }

    public function answerStore(Request $request){
        $question_id = $request->question_id[0];
        $survey_id = DB::table('questions')->where('id', $question_id)->first(); 

        //var_dump($survey_id);exit;
        $answers = $request->answer;
        
        foreach ($answers as $ans){
            $data['survey_id']      = $survey_id->survey_id;
            $data['survey_unq_id']  = $survey_id->survey_unq_id;
            $data['answer']         = $ans;
            \DB::table('answers')->insert($data);

        }

        
    }
}
