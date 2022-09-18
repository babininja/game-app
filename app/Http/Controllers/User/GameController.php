<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Contracts\AnswerRepositoryInterface;
use App\Http\Repositories\Contracts\GameQuestionRepositoryInterface;
use App\Http\Repositories\Contracts\GameRepositoryInterface;
use App\Http\Repositories\Contracts\QuestionRepositoryInterface;
use App\Http\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\User\CheckAnswerRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameController extends Controller
{
    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @var GameRepositoryInterface
     */
    private $gameRepository;

    /**
     * @var GameQuestionRepositoryInterface
     */
    private $gameQuestionRepository;

    /**
     * @var AnswerRepositoryInterface
     */
    private $answerRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * GameController constructor.
     * @param QuestionRepositoryInterface $questionRepository
     * @param GameRepositoryInterface $gameRepository
     * @param UserRepositoryInterface $userRepository
     * @param AnswerRepositoryInterface $answerRepository
     * @param GameQuestionRepositoryInterface $gameQuestionRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository,
                                GameRepositoryInterface $gameRepository,
                                UserRepositoryInterface $userRepository,
                                AnswerRepositoryInterface $answerRepository,
                                GameQuestionRepositoryInterface $gameQuestionRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->userRepository = $userRepository;
        $this->gameRepository = $gameRepository;
        $this->gameQuestionRepository = $gameQuestionRepository;
        $this->answerRepository = $answerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function startGame()
    {
        $questions = $this->questionRepository->getFiveRandomQuestion();

        if ($questions->count() != 5) {
            return redirect()->route('dashboard')->withErrors(['message' => 'there is no enough questions for game']);
        }

        $game = $this->gameRepository->createGame(['user_id' => auth()->id()]);
        foreach ($questions as $question) {
            $this->gameQuestionRepository->create([
                'game_id' => $game->id,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('getGame', ['id' => $game->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return Response
     */
    public function getGame($id)
    {
        if (!$game = $this->gameRepository->find($id)) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        if ($game->user_id !== auth()->id()) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $question = $this->gameQuestionRepository->getFirstUnAnsweredQuestion($id);
        if ($question) {
            return view('user.game.question')->with([
                'question' => $question
            ]);
        }

        $score = $this->gameQuestionRepository->getScore($id);
        $this->gameRepository->updateScore($id, $score);
        $this->userRepository->updateBestScore($score);

        return view('user.game.results')->with([
            'score' => $score
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CheckAnswerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function checkAnswer(CheckAnswerRequest $request)
    {
        if (!$game = $this->gameRepository->findGameForUser($request->validated())) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        if (!$question = $this->gameQuestionRepository->getByFilters($request->validated())) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        if (!$answer = $this->answerRepository->findByFilter([
            'answer_id' => $request->get('answer_id'),
            'question_id' => $question->question_id,
        ])) {
            return abort(Response::HTTP_NOT_FOUND);
        }

        $this->gameQuestionRepository->updateAnswer($question->id, [
            'answer_id' => $answer->id,
            'is_correct' => $answer->is_correct,
            'taken_score' => $answer->is_correct == 1 ? $question->question->points : 0,
        ]);

        if ($answer->is_correct == 1) {
            $correctAnswer = $answer->id;
        } else {
            $correctAnswer = $this->answerRepository->getCorrectAnswer($question->question_id);

        }

        return response()->json([
            'correct_answer' => $correctAnswer
        ]);
    }
}
