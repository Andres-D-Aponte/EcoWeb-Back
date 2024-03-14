<?php

namespace App\Services\Calculate;

use App\Services\Calculate\InteresSimple\CalculateInterestSimpleService;

class OrchestratorService
{
    private $calculateInteresSimpleService;

    public function __construct(CalculateInterestSimpleService $calculateInteresSimpleService){
        $this->calculateInteresSimpleService = $calculateInteresSimpleService;
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
            
            case 'ANUALIDAD':
                return $this->resolve($this->calculateAnnuityService->calculate($request));
                break;
            
            default:
                # code...
                break;
        }
    }

    function resolve($data){
        return [
            "result" => $data
        ];
    }
}
