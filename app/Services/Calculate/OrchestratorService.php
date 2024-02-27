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
        switch ($data->type_interest) {
            case 'SIMPLE':
                return $this->resolve($this->calculateInteresSimpleService->calculate($request));
                break;

            case 'COMPUESTO':
                return $this->resolve($this->calculateInteresCompoundService->calculate($request));
                break;
            
            default:
                # code...
                break;
        }
    }

    public function resolve($data)
    {
        return [
            "result" => $data
        ];
    }
}

