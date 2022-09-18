@extends('layouts.management_master')

@section('title', 'Who wants to be a millionaire')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="rounded mx-auto d-block"
                         src="{{ asset('images/who-wants-to-be-a-millionaire.png') }}"/>
                    <h1 class="text-center">Who wants to be a millionaire</h1>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-3 text-center">
                    Management panel
                </div>
            </div>
        </div>
    </div>
@stop
