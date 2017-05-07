<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require 'vendor/autoload.php';

use App\rule\RuleSet;

$s = new RuleSet();

$s->addDep('A', 'B');
//$s->addDep('B', 'C');
$s->addConflict('A', 'B');

//echo $s->isCoherent() === true ? 'Coerente' : 'Incoerente';

/*echo '<pre>';print_r($s->getDependenciesSet());
echo '<br><br><br>';
$conflicts = [['A', 'B']];
echo $s->checkCoherence($s->getDependenciesSet(), $conflicts) === true ? 'Coerente' : 'Incoerente';*/

