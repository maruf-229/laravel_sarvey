@extends('user.layout')
@section('admin')

    <div class="container-full">
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Form ID</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($surveys as $survey)
                        <tr>
                            <td>{{ $survey->name }}</td>
                            <td>{{ $survey->unq_id }}</td>
                            <td>
                                <a href="{{ route('question_create',$survey->id) }}" class="btn btn-info">Create Questions</a>
                                <a href="{{ route('show_form',$survey->unq_id) }}" class="btn btn-dark">View Form</a>
                            </td>
                        </tr>
                    @endforeach    
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <h5>Create Survey</h5>
                <form action="{{ route('survey_store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Survey Name</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Survey Details</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    
                    <input type="submit" class="btn btn-primary mb-5" value="Insert">
                </form>
            </div>
        </div>
    </div>


@endsection

 