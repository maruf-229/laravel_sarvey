@extends('user.layout')
@section('admin')

    <div class="container-full">
        <div class="row">
            <div class="col-8">
                <h3>Survey Code : {{ $survey->unq_id }}</h3>
                <h4>Survey Name : {{ $survey->name }}</h4>
                <h4>Survey Description :</h4>
                <p>{{ $survey->description }}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Feedback ID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->feedback_unq_id }}</td>
                            <td>
                                <a href="{{ route('view_answers',$feedback->feedback_unq_id) }}" class="btn btn-info">View Answers</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

