<?php

namespace App\Services\Calculate\Amortization;


class CalculateAmortizationService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "AMORTIZACION") return $this->calculateAmortization($data);
        if($data->type_calculate == "CAPITALIZACION") return $this->calculateCapitalization($data);
    }

    private function calculateAmortization($data)
    {
        $annual_amortization = $data->active_cost / $data->useful_life;
        //$annual_amortization = strval($annual_amortization);
        return $annual_amortization . ' Amortizacion anual lineal';
    }

    private function calculateCapitalization($data)
    {
        $future_value = $data->present_value * pow( 1 + ($data->interestRate/100), $data->useful_life);
        return number_format($future_value, 1);
    }
}