<?php

namespace App\Http\Repositories\Models;

use App\Http\Repositories\Contracts\QuestionRepositoryInterface;
use App\Models\Question;

/**
 * Class UserRepository
 * @package App\Http\Repositories\Models
 */
class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
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
        return Question::class;
    }


    /**
     * @param array $inputs
     * @return mixed
     */
    public function createQuestion(array $inputs)
    {
        return parent::create($this->filterRequest($inputs));
    }

    /**
     * @param array $inputs
     * @param int $id
     * @return mixed
     */
    public function updateQuestion(array $inputs, int $id)
    {
        return parent::update($this->filterRequest($inputs),$id);
    }

    /**
     * @return mixed
     */
    public function getFiveRandomQuestion()
    {
        return $this->model->where('active',1)->inRandomOrder()->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getByPaginate()
    {
        return $this->model->orderByDesc('created_at')->paginate(10);
    }

    /**
     * @param array $inputs
     * @return mixed
     */
    private function filterRequest(array $inputs)
    {
        return [
            'title' => $inputs['title'],
            'points' => $inputs['points'],
            'active' => intval(!empty($inputs['active']) && $inputs['active'] == 'on'),
        ];
    }
}
