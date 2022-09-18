<?php

namespace App\Http\Repositories\Models;

use App\Http\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * Class UserRepository
 * @package App\Http\Repositories\Models
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
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
        return User::class;
    }

    /**
     * @param array $inputs
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createUser(array $inputs)
    {
        return parent::create($this->formatCreateFields($inputs));
    }

    /**
     * @param $fields
     * @return array
     */
    private function formatCreateFields(array $fields)
    {
        return [
            'email' => $fields['email'],
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'password' => Hash::make($fields['password']),
        ];
    }

    /**
     * @param $input
     * @param $field
     * @return mixed
     */
    public function getUsersByField($input, $field)
    {
        return $this->model->where($field, $input)->first();
    }

    /**
     * @return mixed
     */
    public function getHighestScores()
    {
        return $this->model->select(['name', 'surname', 'best_score'])->orderByDesc('best_score')->limit(10)->get();
    }

    /**
     * @param int $score
     * @return mixed
     */
    public function updateBestScore(int $score)
    {
        if (auth()->user()->best_score < $score) {
            return parent::update([
                'best_score' => $score
            ], auth()->id());
        }

        return [];
    }
}
