<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:admin');
});
 


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $surveys = DB::table('surveys')->orderBy('id','DESC')->get();
        return view('dashboard',compact('surveys'));
    })->name('dashboard');
});

Route::get('/user/logout' , [UserController::class, 'UserLogout'])->name('user.logout');


Route::post('/user/store-survey' , [UserController::class, 'surveyStore'])->name('survey_store');

Route::get('/user/create-form/{id}' , [UserController::class, 'create_form'])->name('question_create');
Route::post('/user/question-survey' , [UserController::class, 'questionStore'])->name('question_store');

Route::get('/survey/form/{id}' , [AnswerController::class, 'showForm'])->name('show_form');
Route::post('/survey/form-store' , [AnswerController::class, 'answerStore'])->name('answer_store');


 