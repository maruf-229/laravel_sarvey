<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Answer;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;

class AnswerController extends Controller
{
    public function showForm($id){
        $survey = Survey::where('unq_id',$id)->first();
        $survey_ques = Question::where('survey_unq_id',$id)->get();
        return view('user.survey_form',compact('survey_ques','survey'));
    }

    public function answerStore(Request $request){
        $question_id = $request->question_id[0];
        $survey_id = Question::where('id', $question_id)->first();

        $feedback_id  = "FEEDBACK-".date('dmyhs').rand(100,999);

        $answers = $request->answer;

        foreach ($answers as $key => $items){
            Answer::insert([
                'feedback_unq_id' => $feedback_id,
                'survey_id' => $survey_id->survey_id,
                'survey_unq_id' => $survey_id->survey_unq_id,
                'question_id' => $request->question_id[$key],
                'answer' => $request->answer[$key]
            ]);
        }



        $survey_unq_id = Survey::where('unq_id',$survey_id->survey_unq_id)->first();
        $user_id = $survey_unq_id->user_id;
        $user = User::where('id',$user_id)->first();
        $userEmail = $user->email;

        dispatch(new SendMailJob($userEmail));

        return redirect()->route('tank_you');
    }

    public function tank_you(){
        return view('user.thankyou');
    }
}
