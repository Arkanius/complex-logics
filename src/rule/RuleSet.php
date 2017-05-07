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

    public function checkCoherence($dependencies = [], $conflicts = [])
    {
        $b = [['A', 'B', 'C'], ['D', 'E']];

        foreach ($dependencies as $d) {
            if (!empty(array_intersect($conflicts, $d))) {
                echo "Encontrado<br><br>";
            }
        }
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

    /**
     * @param $resorce
     * @return mixed
     */
    public function __get($data)
    {
        return $this->$data;
    }

    /**
     * @param $data
     * @param $value
     */
    public function __set($data, $value)
    {
        $this->$data = $value;
    }

}