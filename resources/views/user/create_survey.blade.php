@extends('user.layout')
@section('admin')

    <div class="container-full">
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Go Back</a>
        <div class="row">
            <div class="col-8">
                <h3>Survey Code : {{ $survey->unq_id }}</h3>
                <h4>Survey Name : {{ $survey->name }}</h4>
                <h4>Survey Description :</h4>
                <p>{{ $survey->description }}</p>
                <hr>
                <h4>Survey Questions</h4>
                @foreach($survey_ques as $ques)
                    <h4>**{{ $ques->question }}</h4>
                    <input type="text" class="form-control" disabled value="User Will fill"><br>
                @endforeach
            </div>
            <div class="col-4">
                <h5>Create Survey Question</h5>
                <form action="{{ route('question_store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                        <input type="hidden" name="survey_unq_id" value="{{ $survey->unq_id }}">
                        <label for="exampleInputEmail1" class="form-label">Create Question</label>
                        <input type="text" class="form-control" name="question">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <input type="submit" class="btn btn-primary mb-5" value="Insert">
                </form>
            </div>
        </div>
    </div>


@endsection

 