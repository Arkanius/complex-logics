<?php

namespace App\options;

use App\rule\RuleSet;

class Options
{
    private $rs;
    private $dataCollection;

    public function __construct(RuleSet $rule)
    {
        $this->rs = $rule;
        $this->dataCollection = [];
    }

    public function toggle($data)
    {
        array_push($this->dataCollection, $data);

        if ($data == end($this->dataCollection)) {
            return $this->dataCollection;
        }
    }

    public function stringSlice()
    {

    }
}