<?php
namespace app\define;

class Request
{
    private $data;

    public function __construct()
    {
        foreach ($_REQUEST as $index => $item) {
            $this->data[$index] = $item;
        }
    }

    public function input($key)
    {
        return @$this->data[$key];
    }
}