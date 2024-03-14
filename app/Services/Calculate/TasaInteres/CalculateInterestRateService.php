<?php

namespace App\Services\Calculate\TasaInteres;


class CalculateInterestRateService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "INTERES SIMPLE") return $this->calculateInterestRateSimple($request);
        if($data->type_calculate == "INTERES COMPUESTO") return $this->calculateInterestRateCompound($request);
    }

    public function calculateInterestRateSimple($request) {
    	$time = $request->time;
        $capital = $request->capital;
        $interestEarned = $request->interestEarned;
        $interestRate = ($interestEarned / ($capital * ($time)))*100;
        return $interestRate . '%';
    }

    public function calculateInterestRateCompound($request) {
    	$time = $request->time;
        $capital = $request->capital;
        $compoundAmount = $request->compoundAmount;
        $factor = pow($compoundAmount / $capital, 1 / $time) - 1;

        $interestRate = $factor * 100;

        return $interestRate . '%';
    }
}