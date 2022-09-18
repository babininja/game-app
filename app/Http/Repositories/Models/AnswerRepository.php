<?php

namespace App\Http\Repositories\Models;

use App\Http\Repositories\Contracts\AnswerRepositoryInterface;
use App\Models\Answer;

/**
 * Class UserRepository
 * @package App\Http\Repositories\Models
 */
class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
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
        return Answer::class;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findByFilter(array $filters)
    {
        return $this->model->where('id', $filters['answer_id'])
            ->where('question_id', $filters['question_id'])
            ->first();
    }

    /**
     * @param int $questionID
     * @return mixed
     */
    public function getCorrectAnswer(int $questionID)
    {
        return $this->model->where('question_id', $questionID)
            ->where('is_correct', 1)
            ->first()->id;
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    public function createAnswer(array $inputs)
    {
        return parent::create($this->filterRequest($inputs));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteAnswerByQuestion(int $id)
    {
        return $this->model->where('question_id',$id)->delete();
    }

    /**
     * @param array $inputs
     * @return array
     */
    private function filterRequest(array $inputs)
    {
        return [
            'question_id' => $inputs['question_id'],
            'title' => $inputs['title'],
            'sort_order' => $inputs['sort_order'],
            'is_correct' => intval(!empty($inputs['is_correct']) && $inputs['is_correct'] == 'on'),
        ];
    }
}
