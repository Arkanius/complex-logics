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
        if (!$this->checkCoherentConflictsPreCondition()) {
            return false;
        }

        foreach ($this->resource as $structure) {
            echo '<br>size: '.count($structure). ' - ';print_r($structure);
        }
    }

    public function checkCoherentConflictsPreCondition()
    {
        $aux = [];
        foreach ($this->resource as $structure) {
            if (count($structure) == 2) {
                $aux[] = $structure;
            }
        }

        if (empty($aux)) {
            return false;
        }

        return true;
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