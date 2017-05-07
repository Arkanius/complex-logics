<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require 'vendor/autoload.php';

use App\rule\RuleSet;

$s = new RuleSet();
$s->addDep('A', 'B');
$s->addDep('B', 'C');
$s->addConflict('C', 'D'); // OK
echo '<br> Rule Set 1: ';
$s->isCoherent();

$z = new RuleSet();
$z->addDep('A', 'B');
$z->addDep('B', 'C');
//$z->addConflict('A', 'C'); // not coherent
echo '<br><br><br> Rule Set 2: ';
$z->isCoherent();

//echo '<pre>';print_r($s->__get('resource'));