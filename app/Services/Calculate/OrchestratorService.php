<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;

class OrchestratorService
{
    private $calculateInteresSimpleService;

    public function __construct(CalculateInterestSimpleService $calculateInteresSimpleService){
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
    }

    function calculate($request){
        $data = (object)$request->all();
        if($data->type_interest == "SIMPLE")
            return $this->resolve($this->calculateInteresSimpleService->calculate($request));
    }

    function resolve($data){
        return [
            "result" => $data
        ];
    }
}
