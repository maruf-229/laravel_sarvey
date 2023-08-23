<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Answer;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Auth;

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

        $feedback_id  = "FEEDBACK-".date('dmyhs').rand(100,999);

        $answers = $request->answer;

        foreach ($answers as $key => $items){
            $data['feedback_unq_id']  = $feedback_id;
            $data['survey_id']        = $survey_id->survey_id;
            $data['survey_unq_id']    = $survey_id->survey_unq_id;
            $data['question_id']      = $request->question_id[$key];
            $data['answer']           = $request->answer[$key];

            DB::table('answers')->insert($data);

        }

        $mailData = [
            'title' => 'A new feedback has beed posted',
            'body' => 'Go to your Survey to view the feedback'
        ];

        $survey_unq_id = DB::table('surveys')->where('unq_id',$survey_id->survey_unq_id)->first();
        $user_id = $survey_unq_id->user_id;
        $user = DB::table('users')->where('id',$user_id)->first();

        Mail::to($user->email)->send(new MyMail($mailData));

        return redirect()->route('tank_you');
    }

    public function tank_you(){
        return view('user.thankyou');
    }
}
