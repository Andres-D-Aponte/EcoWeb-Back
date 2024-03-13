<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;
<<<<<<< HEAD
use App\Services\Calculate\InteresCompuesto\CalculateInterestCompoundService;
use App\Services\Calculate\TasaInteres\CalculateInterestRateService;
=======
use App\Services\Calculate\InteresCompound\CalculateInterestCompoundService;
use App\Services\Calculate\Annuity\CalculateAnnuityService;
>>>>>>> e9cc91da4e2d3dcbdf3e7327e9656221f058005a

class OrchestratorService
{
    private $calculateInteresSimpleService;
    private $calculateInteresCompoundService;
<<<<<<< HEAD
    private $calculateInteresRateService;
=======
    private $calculateAnnuityService;
>>>>>>> e9cc91da4e2d3dcbdf3e7327e9656221f058005a

    public function __construct(
        CalculateInterestSimpleService $calculateInteresSimpleService,
        CalculateInterestCompoundService $calculateInteresCompoundService,
<<<<<<< HEAD
        CalculateInterestRateService $calculateInteresRateService
    ) {
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
        $this->calculateInteresCompoundService = $calculateInteresCompoundService;
        $this->calculateInteresRateService = $calculateInteresRateService;
=======
        CalculateAnnuityService $calculateAnnuityService
    ) {
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
        $this->calculateInteresCompoundService = $calculateInteresCompoundService;
        $this->calculateAnnuityService = $calculateAnnuityService;
>>>>>>> e9cc91da4e2d3dcbdf3e7327e9656221f058005a
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

