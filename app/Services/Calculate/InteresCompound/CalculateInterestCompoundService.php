<?php

namespace App\Services\Calculate\InteresCompound;


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
        $capital = number_format($capital, 2);
        return $capital;
    }

    public function calculateInterestRate($request) {
    	$time = $request->time;
        $capital = $request->capital;
        $compoundAmount = $request->compoundAmount;
        $factor = pow($compoundAmount / $capital, 1 / $time) - 1;

        $interestRate = $factor * 100;

        $interestRate = number_format($interestRate, 1);

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

    public function calculateTime($request){
        $capital = $request->capital;
        $compoundAmount = $request->compoundAmount;
        $interestRate = $request->interestRate / 100;
        $showTime = $request->showTime;

        $time = (log($compoundAmount) - log($capital)) / log(1 + $interestRate);

        switch ($showTime) {
            case "AÑOS":
                return number_format($time, 2) . " AÑOS";
            case "MESES":
                return number_format($time * 12, 2) . " MESES";
            case "DIAS":
                return number_format($time * 360, 2) . " DIAS";
            case "SEMESTRE":
                return number_format($time * 2, 2) . " SEMESTRE";
            case "CUATRIMESTRE":
                return number_format($time * 3, 2) . " CUATRIMESTRE";
            case "TRIMESTRE":
                return number_format($time * 4, 2) . " TRIMESTRE";
            case "BIMESTRE":
                return number_format($time * 6, 2) . " BIMESTRE";
            case "QUINCENA":
                return number_format($time * 24, 2) . " QUINCENA";
            case "SEMANA":
                return number_format($time * 52, 2) . " SEMANA";
            default:
                return number_format($time, 2);
        }
    }

}
