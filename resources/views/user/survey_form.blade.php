<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Survey Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    <div class="container">

        <div class="container-full">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <h3>Survey Code : {{ $survey->unq_id }}</h3>
                    <h4>Survey Name : {{ $survey->name }}</h4>
                    <h4>Survey Description :</h4>
                    <p>{{ $survey->description }}</p>
                    <hr>
                    <h4>Survey Questions</h4>
                    <form action="{{ route('answer_store') }}" method="POST">
                    @csrf
                        @foreach($survey_ques as $ques)
                            <h4>**{{ $ques->question }}</h4>
                            <input type="hidden" class="form-control" name="question_id[]" value="{{ $ques->id  }}">
                            <input type="text" class="form-control" name="answer[]"><br>
                        @endforeach
                        
                        <input type="submit" class="btn btn-primary mb-5" value="Submit">
                    </form>
                    
                </div>
                <div class="col-2"></div>
            </div>
        </div>

    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

 