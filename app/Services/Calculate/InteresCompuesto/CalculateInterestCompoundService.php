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

    public function calculateTime($request)
    {
        $capital = $request->capital;
        $compoundAmount = $request->compoundAmount;
        $interestRate = $request->interestRate / 100;
        $showTime = $request->showTime;

        $time = (log($compoundAmount) - log($capital)) / log(1 + $interestRate);

        switch ($showTime) {
            case "years":
                return $time;
            case "months":
                return $time * 12;
            case "days":
                return $time * 360;
            case "semester":
                return $time * 2;
            case "quarter":
                return $time * 3;
            case "trimester":
                return $time * 4;
            case "bimester":
                return $time * 6;
            case "fortnight":
                return $time * 24;
            case "week":
                return $time * 52;
            default:
                return 0;
        }
        
    }
}
