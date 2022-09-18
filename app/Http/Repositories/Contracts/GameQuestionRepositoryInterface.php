<?php

namespace App\Http\Repositories\Contracts;

interface GameQuestionRepositoryInterface
{
    public function getFirstUnAnsweredQuestion(int $gameID);

    public function getScore(int $gameID);

    public function getByFilters(array $filters);

    public function updateAnswer(int $id, array $data);
}
