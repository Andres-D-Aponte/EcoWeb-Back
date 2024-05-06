<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;
use App\Services\Calculate\InteresCompound\CalculateInterestCompoundService;
use App\Services\Calculate\TasaInteres\CalculateInterestRateService;
use App\Services\Calculate\Annuity\CalculateAnnuityService;
use App\Services\Calculate\InternalRateReturn\CalculateInternalRateReturnService;
use App\Services\Calculate\Gradients\CalculateGradientService;
use App\Services\Calculate\Amortization\CalculateAmortizationService;

class OrchestratorService
{
    private $calculateInteresSimpleService;
    private $calculateInteresCompoundService;
    private $calculateInterestRateService;
    private $calculateAnnuityService;
    private $calculateInternalRateReturnService;
    private $calculateGradientService;
    private $calculateAmortizationService;

    public function __construct(
        CalculateInterestSimpleService $calculateInteresSimpleService,
        CalculateInterestCompoundService $calculateInteresCompoundService,
        CalculateInterestRateService $calculateInteresRateService,
        CalculateAnnuityService $calculateAnnuityService,
        CalculateInternalRateReturnService $calculateInternalRateReturnService,
        CalculateGradientService $calculateGradientService,
        CalculateAmortizationService $calculateAmortizationService
        

    ) {
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
        $this->calculateInteresCompoundService = $calculateInteresCompoundService;
        $this->calculateInterestRateService = $calculateInteresRateService;
        $this->calculateAnnuityService = $calculateAnnuityService;
        $this->calculateInternalRateReturnService = $calculateInternalRateReturnService;
        $this->calculateGradientService = $calculateGradientService;
        $this->calculateAmortizationService = $calculateAmortizationService;
    }

    public function calculate($request)
    {
        $data = (object) $request->all();
        switch ($data->type_interest) {
            case 'INTERES SIMPLE':
                return $this->resolve($this->calculateInteresSimpleService->calculate($request));
                break;

            case 'INTERES COMPUESTO':
                return $this->resolve($this->calculateInteresCompoundService->calculate($request));
                break;
            
            case 'TASA DE INTERES':
                return $this->resolve($this->calculateInterestRateService->calculate($request));
                break;
            
            case 'TASA INTERNA DE RETORNO':
                return $this->resolve($this->calculateInternalRateReturnService->calculate($request));
                break;

            case 'GRADIENTES':
                return $this->resolve($this->calculateGradientService->calculate($request));
                break;

            case 'AMORTIZACION':
                return $this->resolve($this->calculateAmortizationService->calculate($request));
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