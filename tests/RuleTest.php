<?php

use App\rule\RuleSet;

class RuleTest extends PHPUnit_Framework_TestCase
{
    public function testDependsAA()
    {
        $s = new RuleSet();
        $s->addDep('A', 'A');

        $this->assertTrue($s->isCoherent());
    }

    public function testDependsAB_BA()
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('B', 'A');

        $this->assertTrue($s->isCoherent());
    }

    public function testExclusiveAB()
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addConflict('A', 'B');

        $this->assertTrue($s->isCoherent());
    }

    public function testExclusiveAB_BC()
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('B', 'C');
        $s->addConflict('A', 'C');
// tem que ser falso
        $this->assertTrue($s->isCoherent());
    }
}