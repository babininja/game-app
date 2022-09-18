<?php

namespace App\Http\Repositories\Models;

use App\Http\Repositories\Contracts\GameRepositoryInterface;
use App\Models\Game;

/**
 * Class UserRepository
 * @package App\Http\Repositories\Models
 */
class GameRepository extends BaseRepository implements GameRepositoryInterface
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
        return Game::class;
    }


    /**
     * @param array $inputs
     * @return mixed
     */
    public function createGame(array $inputs)
    {
        return parent::create($this->filterCreateGame($inputs));
    }

    /**
     * @param $id
     * @param $score
     * @return mixed
     */
    public function updateScore(int $id, int $score)
    {
        return parent::update(['score' => $score], $id);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findGameForUser(array $filters)
    {
        return $this->model->where('user_id',auth()->id())
            ->where('id',$filters['game_id'])
            ->first();
    }

    /**
     * @param array $inputs
     * @return array
     */
    private function filterCreateGame(array $inputs)
    {
        return [
            'user_id' => $inputs['user_id']
        ];
    }
}
