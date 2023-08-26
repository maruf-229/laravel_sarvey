<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function surveyStore(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Insert Survey Name',
        ]);

        Survey::insert([
            'unq_id' => "SURVEY-".date('dmyhs').rand(100,999),
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back();
    }

    public function create_form($id){
        $survey = Survey::findOrFail($id);
        $survey_ques = Question::where('survey_id',$id)->get();
        return view('user.create_survey',compact('survey_ques','survey'));
    }

    public function questionStore(Request $request){
        $request->validate([
            'question' => 'required',
        ],[
            'question.required' => 'Insert Question',
        ]);

        Question::insert([
            'survey_id' => $request->survey_id,
            'survey_unq_id' => $request->survey_unq_id,
            'question' => $request->question,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function show_feedback($id){
        $survey = Survey::where('unq_id',$id)->first();
        $feedbacks = Answer::where('survey_unq_id',$id)->select('feedback_unq_id')->groupBy('feedback_unq_id')->get();

        return view('user.feedbackList',compact('survey','feedbacks'));
    }

    public function view_answers($id){
        $answers = Answer::where('feedback_unq_id',$id)->get();
        return view('user.feedbackAns',compact('answers'));
    }
}
