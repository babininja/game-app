@extends('layouts.master')

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
                    Welcome to the free online version of the award-winning game show Who Wants to Be a Millionaire?.
                    The show has aired for nearly two decades and produced an impressive list of instant-millionaires.
                    And now the free online version offers everyone the same chance to succeed in turning knowledge into
                    real wealth.
                    <br><br>
                    The game is open to anyone willing to put their knowledge to the test in a series of questions and
                    answers. You should login first and just keep your wits about you, have fun, and get rich! So if you’re in the mood to make a
                    quick million virtual dollars for yourself, this is your chance.
                    <br><br>
                    The game consists of 5 questions. The level of difficulty is random. For example, if you answer
                    the first question correctly you score from 5 to 20 points based on questions difficulty.
                    <br><br>
                    Keep in mind that your intellect and knowledge are the keys to success. Think you’ve got what it
                    takes? Then go ahead and play! Put all those random facts you’ve collected over the years to good
                    use and turn it into a quick and easy million virtual dollars.
                </div>
            </div>
        </div>
    </div>
@stop
