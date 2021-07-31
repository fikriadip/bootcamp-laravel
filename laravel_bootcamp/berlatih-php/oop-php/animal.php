<?php

class Animal{
    public $legs = 2;
    public $katak = 4;
    public $cold_blooded = false;
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    
}
