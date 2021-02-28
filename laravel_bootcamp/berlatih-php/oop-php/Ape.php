<?php
require_once "animal.php";
class Ape extends Animal {
    public $names;
    public function __construct($names)
    {
        $this->names = $names;
    }
    public function yell()
    {
        print "Auooo";
    }
}
