<?php

namespace App\Http\Repositories\Contracts;

interface AnswerRepositoryInterface
{
    public function findByFilter(array $filters);

    public function getCorrectAnswer(int $questionID);

    public function createAnswer(array $inputs);

    public function deleteAnswerByQuestion(int $id);
}
