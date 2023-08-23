<?php

namespace App\Http\Controllers;

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

        $data = [];
        $data['unq_id']         = "SURVEY-".date('dmyhs').rand(100,999);
        $data['user_id']        = Auth::user()->id;
        $data['name']           = $request->name;
        $data['description']    = $request->description;
        $data['status']         = 1;
        $data['created_at']     = Carbon::now();

        DB::table('surveys')->insert($data);

        return redirect()->back();
    }

    public function create_form($id){
        $survey = DB::table('surveys')->where('id',$id)->first();
        $survey_ques = DB::table('questions')->where('survey_id',$id)->get();
        return view('user.create_survey',compact('survey_ques','survey'));
    }

    public function questionStore(Request $request){
        $request->validate([
            'question' => 'required',
        ],[
            'question.required' => 'Insert Question',
        ]);

        $data = [];
        $data['survey_id']      = $request->survey_id;
        $data['survey_unq_id']  = $request->survey_unq_id;
        $data['question']       = $request->question;
        $data['created_at']     = Carbon::now();

        DB::table('questions')->insert($data);

        return redirect()->back();
    }

    public function show_feedback($id){
        $survey = DB::table('surveys')->where('unq_id',$id)->first();
        $feedbacks = DB::table('answers')->where('survey_unq_id',$id)->select('feedback_unq_id')->groupBy('feedback_unq_id')->get();

        return view('user.feedbackList',compact('survey','feedbacks'));
    }

    public function view_answers($id){
        $answers = DB::table('answers')
                ->join('questions','answers.question_id','questions.id')
                ->select('questions.question','answers.*')
                ->where('answers.feedback_unq_id',$id)
                ->get();
        return view('user.feedbackAns',compact('answers'));
    }
}
