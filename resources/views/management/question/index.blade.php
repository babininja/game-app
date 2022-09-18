@extends('layouts.management_master')

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
                    <a href="{{ route('questions.create') }}" class="btn btn-success mb-2">Create new question</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Active</th>
                            <th scope="col">Points</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $key => $question)
                            <tr>
                                <th scope="row">{{ ((request()->get('page',1)-1) * 10) + $key + 1 }}</th>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->active==1 ? 'active' : 'inactive' }}</td>
                                <td>{{ $question->points }}</td>
                                <td>{{ $question->created_at }}</td>
                                <td>
                                    <a href="{{ route('questions.edit',$question->id) }}" class="btn btn-success">Edit</a>
                                    <form action="{{ route('questions.destroy',$question->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $questions ? $questions->links() : '' }}
                </div>
            </div>
        </div>
    </div>
@stop
