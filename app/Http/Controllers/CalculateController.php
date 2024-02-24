<?php

namespace App\Http\Controllers;

use App\Services\Calculate\OrchestratorService;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    private $orchestratorService;

    public function __construct(OrchestratorService $orchestratorService){
        $this->orchestratorService = $orchestratorService;
    }

    function calculate(Request $request){
        return response()->json($this->orchestratorService->calculate($request));
    }
}
