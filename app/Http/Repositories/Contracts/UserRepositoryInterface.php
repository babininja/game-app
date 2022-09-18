<?php

namespace App\Http\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function createUser(array $inputs);

    public function getUsersByField($input, $field);

    public function getHighestScores();

    public function updateBestScore(int $score);
}
