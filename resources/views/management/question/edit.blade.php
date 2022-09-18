@extends('layouts.management_master')

@section('title', 'Who wants to be a millionaire')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="rounded mx-auto d-block"
                         src="{{ asset('images/who-wants-to-be-a-millionaire.png') }}"/>
                    <h1 class="text-center">Update question</h1>
                </div>

                <div class="mt-8 rounded mx-auto d-block bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-3 col-8">
                    <form action="{{ route('questions.update',$question->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="col-12 mb-2 text-center">
                            <label for="title" class="col-5">Title</label>
                            <input name="title" value="{{ $question->title }}" class="form-control col-10">
                        </div>
                        <div class="col-12 text-center">
                            <label for="points" class="col-5">Points</label>
                            <input name="points" min="5" max="20" type="number" value="{{ $question->points }}"
                                   class="form-control col-10">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input ml-5" type="checkbox"
                                   {{ $question->active ? 'checked' : '' }} name="active" id="active">
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                        </div>
                        <button id="addAnswer" class="btn btn-success mt-2">Add answer</button>
                        <div id="answer-box">
                            Answers
                            @foreach($question->answers as $key => $answer)
                                <div class="col-12 mb-2 text-center">
                                    <label for="title" class="col-5">Title</label>
                                    <input name="answer[{{ $key }}][title]" value="{{ $answer->title }}"
                                           class="form-control col-10">
                                </div>
                                <div class="col-12 text-center">
                                    <label for="sort_order" class="col-5">Sort order</label>
                                    <input name="answer[{{ $key }}][sort_order]" type="number"
                                           value="{{ $answer->sort_order }}" class="form-control col-10">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ml-5" type="checkbox" {{ $answer->is_correct ? 'checked' : '' }}
                                           name=" answer[{{ $key }}][is_correct]" id="is_correct">
                                    <label class="form-check-label" for="is_correct">
                                        Is correct
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        var key = {{ !empty($key) ? $key+1 : 0 }};
        $('#addAnswer').click(function (e) {
            e.preventDefault();
            var answerBox = '<div class="col-12 mb-2 text-center">\n' +
                '                                <label for="title" class="col-5">Title</label>\n' +
                '                                <input name="answer[' + key + '][title]" class="form-control col-10">\n' +
                '                            </div>\n' +
                '                            <div class="col-12 text-center">\n' +
                '                                <label for="sort_order" class="col-5">Sort order</label>\n' +
                '                                <input name="answer[' + key + '][sort_order]" type="number" ' +
                '                                   class="form-control col-10">\n' +
                '                            </div>\n' +
                '                            <div class="form-check">\n' +
                '                                <input class="form-check-input ml-5" type="checkbox" ' +
                '                                   name="answer[' + key + '][is_correct]" id="is_correct">\n' +
                '                                <label class="form-check-label" for="is_correct">\n' +
                '                                    Is correct\n' +
                '                                </label>\n' +
                '                            </div>';
            key++;
            $('#answer-box').append(answerBox);
        });
    </script>
@stop
