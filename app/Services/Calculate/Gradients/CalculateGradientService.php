<?php

namespace App\Services\Calculate\Gradients;


class CalculateGradientService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "GRADIENTE ARITMETICO") return $this->calcularGradienteAritmetico($data);
        if($data->type_calculate == "GRADIENTE GEOMETRICO") return $this->calcularGradienteGeometrico($data);
    }

    private function calcularGradienteAritmetico($data)
    {
        $vf_total = 0;
        $tasa_interes = $data->interestRate / 100;
        $consignaciones = (object)$data->consignaciones;

        foreach ($consignaciones->monto as $index => $monto) {
            $meses = $consignaciones->meses[$index];

            if ($meses != 0) {
                $vf_cons = $monto * pow(1 + $tasa_interes, $meses);
            } else {
                $vf_cons = $monto;
            }

            $vf_total += $vf_cons;
        }

        return  number_format($vf_total, 2);
    }


    private function calcularGradienteGeometrico($data)
    {
        $P = $data->consignaciones['monto']['0']; // Primer pago
        $i = $data->interestRate / 100; // Tasa de interés por período
        $n = intval($data->num_gradients); // Número de períodos
        $g = $data->incremento / 100; // Tasa de crecimiento por período (para gradientes geométricos)
 
        //$vp = ($P * (pow(1 + $i, $n)) - (pow(1 + $g, $n))) / ($i - $r);
        $vf = $P * ((pow(1 + $i, $n) - pow(1 + $g, $n)) / ($i - $g));
        return  number_format($vf,2);
    }

    
}