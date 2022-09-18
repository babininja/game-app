<?php

namespace App\Http\Repositories\Contracts;

interface GameRepositoryInterface
{
    public function createGame(array $inputs);

    public function updateScore(int $id, int $score);

    public function findGameForUser(array $filters);
}
