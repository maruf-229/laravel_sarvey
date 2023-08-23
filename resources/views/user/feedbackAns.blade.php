@extends('user.layout')
@section('admin')

    <div class="container-full">
        <div class="row">
            <div class="col-8">
                @foreach($answers as $answer)
                    <h4>**{{ $answer->question }}</h4>
                    <input type="text" class="form-control" readonly value="{{ $answer->answer }}"><br>
                @endforeach
            </div>
        </div>
    </div>


@endsection

