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

    function calculate($request){
        $data = (object)$request->all();
        if($data->type_interest == "SIMPLE")
            return $this->resolve($this->calculateInteresSimpleService->calculate($request));
    }

    public function resolve($data)
    {
        return [
            "result" => $data
        ];
    }
}

