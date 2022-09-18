@extends('layouts.master')

@section('title', 'Who wants to be a millionaire')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="rounded mx-auto d-block"
                         src="{{ asset('images/who-wants-to-be-a-millionaire.png') }}"/>
                    <h1 class="text-center">Questions</h1>
                </div>

                <div class="mt-8 rounded mx-auto d-block bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-3 text-center col-8">
                    <span class="col-12 text-center">{{ $question->question->title }}</span>
                    @foreach($question->question->answers as $answer)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" value="{{ $answer->id }}">
                            <label class="form-check-label" for="answer">
                                {{ $answer->title }}
                            </label>
                        </div>
                    @endforeach
                    <button id="submitButton" class="btn btn-success mt-2">submit</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $('#submitButton').click(function () {
            $.ajax({
                "url": "{{ route('checkAnswer') }}",
                "method": "POST",
                "timeout": 0,
                "data": {
                    "_token": "{{csrf_token()}}",
                    "question_id": "{{ $question->id }}",
                    "answer_id": $("input[name='answer']:checked").val(),
                    "game_id": "{{ $question->game_id }}"
                }
            }).done(function (response) {
                if($("input[name='answer']:checked").val() == response.correct_answer){
                    $("input[name='answer']:checked").parent().css("backgroundColor","#32f732");
                }else{
                    $("input[name='answer']:checked").parent().css("backgroundColor","#f93e3e");
                    $("input[name='answer'][value=" + response.correct_answer + "]").parent().css("backgroundColor","#32f732");
                }

                setTimeout( function(){
                    location.reload();
                }  , 1000 );
            });
        })
    </script>
@stop
