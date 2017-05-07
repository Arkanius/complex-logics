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

        return $this->checkCoherence($this->getDependenciesSet(), $conflicts);
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

    /**
     * Get set of unique dependencies
     *
     * @return array
     */
    public function getDependenciesSet()
    {
        $dependencies  = $this->getDependencies($this->resource);
        $dependencySet = [];
        $aux           = [];
        foreach ($dependencies as $i => $dep) {
            $arAux = [key($dep), $dep[key($dep)]];

            for ($x = $i; $x < count($dependencies); $x++) {
                if ($x == $i) {
                    continue;
                }
                if (!empty(count(array_intersect($arAux,
                        [key($dependencies[$x]), $dependencies[$x][key($dependencies[$x])]])))) {
                    array_push($dependencySet, key($dep), $dep[key($dep)],
                        key($dependencies[$x]), $dependencies[$x][key($dependencies[$x])]);
                    continue;
                }
                array_push($aux, key($dep), $dep[key($dep)],
                    key($dependencies[$x]), $dependencies[$x][key($dependencies[$x])]);

/*                echo '<br> i: '.$i.' - x: '.$x.' - '
                    .key($dep).','.$dep[key($dep)].
                    ' - '.key($dependencies[$x]).','.$dependencies[$x][key($dependencies[$x])];*/
            }
        }
        $result = [];
        $dependencySet  = array_unique($dependencySet);
        array_push($result, array_diff(array_unique($aux), $dependencySet), $dependencySet);
        return $result;
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
                $aux[] = array_keys($structure);
            }
        }

        if (empty($aux)) {
            return true;
        }

        return $aux;
    }
}