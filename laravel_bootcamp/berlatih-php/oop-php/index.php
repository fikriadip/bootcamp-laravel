
<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

require_once "animal.php";
require_once "Ape.php";
require_once "Frog.php";

$sheep = new Animal("Shaun");
echo $sheep->name . "<br>"; // "shaun"
echo $sheep->legs . "<br>"; // 2
var_dump($sheep->cold_blooded);
print "<hr>";

$sungokong = new Ape("Kera Sakti");
echo $sungokong->names . "<br>";
echo $sungokong->legs . "<br>";
$sungokong->yell(); // "Auooo"
print "<hr>";

$kodok = new Frog("Buduk");
echo $kodok->nama . "<br>";
echo $kodok->katak . "<br>";
$kodok->jump(); // "hop hop"


?>


