<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;
use App\Services\Calculate\InteresCompuesto\CalculateInterestCompoundService;
use App\Services\Calculate\TasaInteres\CalculateInterestRateService;

class OrchestratorService
{
    private $calculateInteresSimpleService;
    private $calculateInteresCompoundService;
    private $calculateInteresRateService;

    public function __construct(
        CalculateInterestSimpleService $calculateInteresSimpleService,
        CalculateInterestCompoundService $calculateInteresCompoundService,
        CalculateInterestRateService $calculateInteresRateService
    ) {
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
        $this->calculateInteresCompoundService = $calculateInteresCompoundService;
        $this->calculateInteresRateService = $calculateInteresRateService;
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
            
            case 'TASA INTERES':
                return $this->resolve($this->calculateInterestRateService->calculate($request));
                break;
            
            case 'ANUALIDAD':
                return $this->resolve($this->calculateAnnuityService->calculate($request));
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

