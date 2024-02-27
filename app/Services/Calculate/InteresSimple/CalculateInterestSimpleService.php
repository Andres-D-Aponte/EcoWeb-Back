<?php

namespace App\Services\Calculate\InteresSimple;


class CalculateInterestSimpleService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "CAPITAL") return $this->calculateCapital($request);
        if($data->type_calculate == "VALOR FUTURO") return $this->calculateFutureValue($request);
        if($data->type_calculate == "TASA DE INTERES") return $this->calculateInterestRate($request);
        if($data->type_calculate == "TIEMPO INVERTIDO") return $this->calculateTime($request);
        if($data->type_calculate == "INTERES PRODUCIDO") return $this->calculateInterestEarned($request);
    }

    public function calculateCapital($request) {
    	$time = $request->time;
        $interestEarned = $request->interestEarned;
        $interestRate = $request->interestRate / 100;
        $capital = ($interestEarned / ($interestRate * $time));
        return $capital;
    }

    public function calculateFutureValue($request){
        $capital = $request->capital;
        $interestRate = $request->interestRate / 100;
        $time = $request->time;

        $newFutureValue = number_format($capital * (1 + ($interestRate * $time)), 2, ',', '.');

        return $newFutureValue;
    }

    public function calculateInterestRate($request) {
    	$time = $request->time;
        $capital = $request->capital;
        $interestEarned = $request->interestEarned;
        $interestRate = ($interestEarned / ($capital * ($time/12)))*100;
        return $interestRate . '%';
    }

    public function calculateTime($request) {
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

    public function calculateInterestEarned($request){
        $time = $request->time;
        $interestRate = $request->interestRate / 100;
        $capital = $request->capital;
        $interestEarned = ($capital * $interestRate * $time);
        return $interestEarned;
    }

}
