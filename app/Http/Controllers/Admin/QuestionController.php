<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Contracts\AnswerRepositoryInterface;
use App\Http\Repositories\Contracts\QuestionRepositoryInterface;
use App\Http\Requests\Admin\StoreQuestionRequest;
use App\Http\Requests\Admin\UpdateQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @var AnswerRepositoryInterface
     */
    private $answerRepository;

    /**
     * QuestionController constructor.
     * @param QuestionRepositoryInterface $questionRepository
     * @param AnswerRepositoryInterface $answerRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository,
                                AnswerRepositoryInterface $answerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getByPaginate();

        return view('management.question.index')->with(compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreQuestionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = $this->questionRepository->createQuestion($request->validated());

        foreach ($request->get('answer') as $answer) {
            $this->answerRepository->createAnswer(array_merge($answer, ['question_id' => $question->id]));
        }

        return redirect()->route('questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('management.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateQuestionRequest $request
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question = $this->questionRepository->updateQuestion($request->validated(), $question->id);

        $this->answerRepository->deleteAnswerByQuestion($question->id);
        foreach ($request->get('answer') as $answer) {
            $this->answerRepository->createAnswer(array_merge($answer, ['question_id' => $question->id]));
        }

        return redirect()->route('questions.edit', $question->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->questionRepository->delete($question->id);

        return redirect()->back();
    }
}
