<?php

namespace App\Services\Calculate\InteresCompuesto;


class CalculateInterestCompoundService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "CAPITAL") return $this->calculateCapital($request);
        if($data->type_calculate == "TASA DE INTERES") return $this->calculateInterestRate($request);
        if($data->type_calculate == "MONTO COMPUESTO") return $this->calculateCompoundAmount($request);
        if($data->type_calculate == "TIEMPO INVERTIDO") return $this->calculateTime($request);
    }

    public function calculateCapital($request) {
    	$time = $request->time;
        $compoundAmount = $request->compoundAmount;
        $interestRate = $request->interestRate / 100;
        $factor = pow(1 + $interestRate, $time);
        $capital = ($compoundAmount / $factor);
        return $capital;
    }

    public function calculateInterestRate($request) {
    	$time = $request->time;
        $capital = $request->capital;
        $compoundAmount = $request->compoundAmount;
        $factor = pow($compoundAmount / $capital, 1 / $time) - 1;

        $interestRate = $factor * 100;

        return $interestRate . '%';
    }

    public function calculateCompoundAmount($request){
        $capital = $request->capital;
        $interestRate = $request->interestRate / 100;
        $time = $request->time;
        $factor = pow(1 + $interestRate, $time);

        $compoundAmount = ($capital * $factor);

        return $compoundAmount;
    }

    public function calculateTime($request) {   //ACTUALIZAR
        $capital = $request->capital;
        $interestEarned = $request->interestEarned;
        $interestRate = $request->interestRate / 100;
        $time = ($interestEarned / ($capital * $interestRate));
        $time = $time * 360;

        $years = floor($time / 360);
        $remainingDays = $time % 360;
        $months = floor($remainingDays / 30);
        $days = round($remainingDays % 30);

        return ['years' => $years, 'months' => $months, 'days' => $days, 'time' => ($time/360)];
    }
}
