<?php
require_once "animal.php";

class Frog extends Animal
{
    public $nama;
    public function __construct($nama)
    {
        $this->nama = $nama;
    }
    protected $frog;
    public function jump()
    {
        print "hop hop";
    }
}
?>