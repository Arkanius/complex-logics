<?php

namespace App\rule;

class RuleSet
{
    private $resource;

    public function __construct()
    {
        $this->resource = [];
    }

    public function addDep(string $optA, string $optB)
    {
        array_push($this->resource, [$optA => $optB]);
    }

    public function addConflict(string $optA, string $optB)
    {
        array_push($this->resource, [$optA => true, $optB => false]);
    }

    public function isCoherent()
    {
        $conflicts = $this->getConflicts();

        if ($conflicts === true) {
            return true;
        }

        foreach ($this->resource as $structure) {
            echo '<br>size: '.count($structure). ' - ';print_r($structure);
        }
    }

    /**
     * Check if Dependency set is coherent depending on conflict set
     *
     * @param array $dependencies
     * @param array $conflicts
     * @return bool
     */
    public function checkCoherence($dependencies = [], $conflicts = [])
    {
        foreach ($dependencies as $dependencyConjunct) {
            foreach ($conflicts as $conflictsConjuncts) {
                if (count(array_intersect($conflictsConjuncts, $dependencyConjunct)) == 2) {
                    return false;
                }
            }
        }

        return true;
    }

    public function getDependenciesSet()
    {
        $dependencies  = $this->getDependencies($this->resource);
        $dependencySet = [];
        print_r($dependencies);
        foreach ($dependencies as $i => $dep) {
            echo'<br>';print_r($dep);
            for ($x = 0; $x < count($dependencies); $x++) {
                if ($x == $i) {
                    continue;
                }
                echo '<br> i: '.$i.' - x: '.$x.' - '.$dependencies[$i];
            }
        }
    }

    /**
     * Get dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        $aux = [];
        foreach ($this->resource as $structure) {
            if (count($structure) == 1) {
                $aux[] = $structure;
            }
        }

        return $aux;
    }

    /**
     * Check if exists conflicts in the existent data
     *  and return them in case of true
     * @return bool
     */
    public function getConflicts()
    {
        $aux = [];
        foreach ($this->resource as $structure) {
            if (count($structure) == 2) {
                $aux[] = $structure;
            }
        }

        if (empty($aux)) {
            return true;
        }

        return $aux;
    }
}