<?php

namespace App\Http\Repositories\Models;

use App\Http\Repositories\Contracts\GameQuestionRepositoryInterface;
use App\Models\GameQuestion;

/**
 * Class UserRepository
 * @package App\Http\Repositories\Models
 */
class GameQuestionRepository extends BaseRepository implements GameQuestionRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return GameQuestion::class;
    }


    /**
     * @param int $gameID
     * @return mixed
     */
    public function getFirstUnAnsweredQuestion(int $gameID)
    {
        return $this->model->where('game_id', $gameID)
            ->whereNull('answer_id')
            ->orderBy('id')
            ->first();
    }

    /**
     * @param int $gameID
     * @return mixed
     */
    public function getScore(int $gameID)
    {
        return $this->model->where('game_id', $gameID)
            ->sum('taken_score');
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function getByFilters(array $filters)
    {
        return $this->model->where('game_id', $filters['game_id'])
            ->where('id', $filters['question_id'])
            ->first();
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateAnswer(int $id, array $data)
    {
        return parent::update([
            'answer_id' => $data['answer_id'],
            'is_correct' => $data['is_correct'],
            'taken_score' => $data['taken_score'],
        ], $id);
    }
}
