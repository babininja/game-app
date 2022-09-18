<?php

namespace App\Http\Repositories\Contracts;

interface QuestionRepositoryInterface
{
    public function getFiveRandomQuestion();

    public function getByPaginate();

    public function createQuestion(array $inputs);

    public function updateQuestion(array $inputs, int $id);
}
