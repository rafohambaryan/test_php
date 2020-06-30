<?php


namespace app\controllers\app;


class ErrorController extends Controller
{
    protected $permission = 'errors/';
    protected $auto_load = 'auto-load';
    protected $layout = 'error-404';
}