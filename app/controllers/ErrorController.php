<?php

use app\controllers\app\ErrorController as Error;

class ErrorController extends Error
{
    public function index()
    {
        $this->title = 'error';
        return $this->view('error-404');
    }
}