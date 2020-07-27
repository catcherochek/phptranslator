<?php
require_once ('vendor/autoload.php');
use \Dejurin\GoogleTranslateForFree;

$source = 'en';
$target = 'ru';
$attempts = 5;
$arr = ['hello','world'];

$tr = new GoogleTranslateForFree();
$result = $tr->translate($source, $target, $arr, $attempts);

var_dump($result); 