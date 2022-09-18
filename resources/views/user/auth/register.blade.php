@extends('layouts.master')

@section('title', 'Who wants to be a millionaire')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="rounded mx-auto d-block"
                         src="{{ asset('images/who-wants-to-be-a-millionaire.png') }}"/>
                    <h1 class="text-center">Register</h1>
                </div>

                <div class="mt-8 rounded mx-auto d-block bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-3 text-center col-8">
                    <form action="{{ route('register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-12">
                            <label for="email" class="col-5">Email</label>
                            <input type="email" name="email" class="form-control col-10">
                        </div>
                        <div class="col-12">
                            <label for="name" class="col-5">Name</label>
                            <input name="name" class="form-control col-10">
                        </div>
                        <div class="col-12">
                            <label for="surname" class="col-5">Surname</label>
                            <input name="surname" class="form-control col-10">
                        </div>
                        <div class="col-12">
                            <label for="password" class="col-5 my-2">Password</label>
                            <input type="password" name="password" class="form-control col-10">
                        </div>
                        <div class="col-12">
                            <label for="password_confirmation" class="col-5 my-2">Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control col-10">
                        </div>
                        <button type="submit" class="btn btn-success mt-2">register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
