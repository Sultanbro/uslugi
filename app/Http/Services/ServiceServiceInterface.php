<?php


namespace App\Http\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

interface ServiceServiceInterface
{
    /**
     * @param array $params
     * @return Builder|Model
     */
    public function store(array $params);

    /**
     * @param array $attribute
     * @param Integer $id
     * @return Builder|Model
     */
    public function update(array $attribute,int $id);



}
