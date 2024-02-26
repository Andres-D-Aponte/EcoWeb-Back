<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;
use App\Services\Calculate\InteresCompuesto\CalculateInterestCompoundService;

class OrchestratorService
{
    private $calculateInteresSimpleService;
    private $calculateInteresCompoundService;

    public function __construct(
        CalculateInterestSimpleService $calculateInteresSimpleService,
        CalculateInterestCompoundService $calculateInteresCompoundService
    ) {
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
        $this->calculateInteresCompoundService = $calculateInteresCompoundService;
    }

    public function calculate($request)
    {
        $data = (object) $request->all();
        if ($data->type_interest == "SIMPLE") {
            return $this->resolve($this->calculateInteresSimpleService->calculate($request));
        } elseif ($data->type_interest == "COMPUESTO") {
            return $this->resolve($this->calculateInteresCompoundService->calculate($request));
        }
    }

    public function resolve($data)
    {
        return [
            "result" => $data
        ];
    }
}

