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
//$s->addDep('D', 'E');
//$s->addDep('A', 'F');
$s->addConflict('B', 'D');
$s->addConflict('B', 'E');

echo $s->isCoherent() === true ? 'Coerente' : 'Incoerente';

/*echo '<pre>';print_r($s->getDependenciesSet());
echo '<br><br><br>';
$conflicts = [['A', 'C']];
echo $s->checkCoherence($s->getDependenciesSet(), $conflicts) === true ? 'Coerente' : 'Incoerente';*/

