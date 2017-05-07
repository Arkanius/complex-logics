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

        $this->assertFalse($s->isCoherent());
    }

    public function testExclusiveAB_BC()
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('B', 'C');
        $s->addConflict('A', 'C');

        $this->assertFalse($s->isCoherent());
    }

    public function testDeepsDeps()
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('B', 'C');
        $s->addDep('C', 'D');
        $s->addDep('D', 'E');
        $s->addDep('A', 'F');
        $s->addConflict('E', 'F');

        $this->assertFalse($s->isCoherent());
    }

    public function testExclusiveAB_BC_CA_DE() //TODO: CONTINUAR
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('B', 'C');
        $s->addDep('C', 'A');
        $s->addDep('D', 'E');
        $s->addConflict('C', 'E');

        $this->assertTrue($s->isCoherent());
    }

    public function testAB_BC_Toggle() //TODO: CONTINUAR
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('B', 'C');

        $this->assertTrue($s->isCoherent());
    }

    public function testAB_AC() //TODO: CONTINUAR
    {
        $s = new RuleSet();
        $s->addDep('A', 'B');
        $s->addDep('A', 'C');
        $s->addConflict('B', 'D');
        $s->addConflict('B', 'E');

        $this->assertTrue($s->isCoherent());
    }
}