<?php

namespace App\Services\Calculate\Annuity;


class CalculateAnnuityService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "VALOR FUTURO") return $this->calculateFutureValue($request);
        if($data->type_calculate == "VALOR ACTUAL") return $this->calculateActualValue($request);
    }

    public function calculateFutureValue($request) {
    	$periods = $request->periods;
        $annuity = $request->annuity;
        $interestRate = $request->interestRate / 100;

        $factor = pow(1 + $interestRate, $periods);

        $futureValue = ($annuity(($factor - 1) / $interestRate));

        return $futureValue;
    }

    public function calculateActualValue($request) {
    	$periods = $request->periods;
        $annuity = $request->annuity;
        $interestRate = $request->interestRate / 100;

        $factor = pow(1 + $interestRate, -$periods);

        $actualValue = ($annuity((1- $factor) / $interestRate));

        return $actualValue;
    }
}