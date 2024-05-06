<?php

namespace App\Services\Calculate\InternalRateReturn;


class CalculateInternalRateReturnService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "TIR") return $this->calculateTIR($request->flujos);
    }

    private function calculateTIR($flujosDeEfectivo)
    {
        $startValue = -1;
        $endValue = 1;

        $tir = null;
        while ($endValue - $startValue > 0.0001) {
            $guess = ($startValue + $endValue) / 2;
            $npv = $this->calculateNPV($flujosDeEfectivo, $guess);
            if ($npv > 0) {
                $startValue = $guess;
            } else {
                $endValue = $guess;
            }
            $tir = $guess;
        }
        $tir = number_format($tir, 4);
        return $tir * 100 . '%';
    }

    private function calculateNPV($flujosDeEfectivo, $tir)
    {
        $npv = 0;
        $n = count($flujosDeEfectivo);

        for ($i = 0; $i < $n; $i++) {
            $npv += $flujosDeEfectivo[$i] / pow(1 + $tir, $i);
        }

        return $npv;
    }
}