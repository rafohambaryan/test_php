<?php


namespace app\controllers\app\Components;


trait Model
{
    protected function model($model): object
    {
        require_once MODEL . $model . PHP;
        return new $model();
    }
}