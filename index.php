<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require 'vendor/autoload.php';

use App\rule\RuleSet;

$s = new RuleSet();

$s->addDep('A', 'B');
//$s->addDep('B', 'A');
$s->addDep('A', 'C');
//$s->addDep('C', 'D');
//$s->addDep('C', 'A');
//$s->addDep('D', 'B');
//$s->addDep('A', 'F');
$s->addConflict('A', 'C');
//$s->isCoherent();


echo '<pre>';print_r($s->getDependenciesSet());
echo '<br><br><br>';
$conflicts = [['B', 'D'], ['B', 'E']];
echo $s->checkCoherence($s->getDependenciesSet(), $conflicts) === true ? 'Coerente' : 'Incoerente';