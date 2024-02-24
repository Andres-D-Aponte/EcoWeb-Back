<?php

namespace App\Services\Calculate\InteresSimple;


class CalculateInterestSimpleService
{
    function calculate($request){
        $data = (object)$request->all();
        if($data->type_calculate == "CAPITAL") return $this->calculateCapital($request);
    }

    public function calculateCapital($request) {
    	$time = $request->time;
        $interestEarned = $request->interestEarned;
        $interestRate = $request->interestRate;
        $capital = ($interestEarned / ($interestRate * $time));
        return $capital;
    }
}
