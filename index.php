<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require 'vendor/autoload.php';

use App\rule\RuleSet;
use App\options\Options;

$s = new RuleSet();

$s->addDep('A', 'B');
$s->addDep('B', 'C');
echo $s->isCoherent() === true ? 'Coerente' : 'Incoerente';

$op = new Options($s);
echo '<pre><br><br>';
print_r($op->toggle('C'));

