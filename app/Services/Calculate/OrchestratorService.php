<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;
use App\Services\Calculate\InteresCompound\CalculateInterestCompoundService;
use App\Services\Calculate\TasaInteres\CalculateInterestRateService;
use App\Services\Calculate\Annuity\CalculateAnnuityService;

class OrchestratorService
{
    private $calculateInteresSimpleService;
    private $calculateInteresCompoundService;
    private $calculateInterestRateService;
    private $calculateAnnuityService;

    public function __construct(
        CalculateInterestSimpleService $calculateInteresSimpleService,
        CalculateInterestCompoundService $calculateInteresCompoundService,
        CalculateInterestRateService $calculateInteresRateService,
        CalculateAnnuityService $calculateAnnuityService
    ) {
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
        $this->calculateInteresCompoundService = $calculateInteresCompoundService;
        $this->calculateInteresRateService = $calculateInteresRateService;
        $this->calculateAnnuityService = $calculateAnnuityService;
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

