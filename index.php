<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require 'vendor/autoload.php';

use App\rule\RuleSet;

$s = new RuleSet();

$s->addDep('A', 'B');
$s->addDep('B', 'C');
$s->addDep('C', 'D');
$s->addDep('D', 'E');
$s->addDep('A', 'F');
$s->addConflict('A', 'C');
//$s->isCoherent();


echo '<pre>';print_r($s->getDependenciesSet());

/*$b = [['A', 'B']];
$conflicts = [['A', 'B']];
echo $s->checkCoherence($b, $conflicts) === true ? 'Coerente' : 'Incoerente';*/