<?php

Class Model
{
    public $string;

    public function __construct()
    {
        $this->string = "Olá Mundo!";
    }

    public function get_string()
    {
        return $this->string;
    }
}