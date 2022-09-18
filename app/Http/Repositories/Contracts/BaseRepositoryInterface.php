<?php
namespace  App\Http\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function find($id, $columns = ['*']);
}
