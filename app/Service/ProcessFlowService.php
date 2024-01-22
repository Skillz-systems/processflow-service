<?php
namespace App\Service;

use App\Models\ProcessFlow;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProcessFlowServiceRequest;

class ProcessFlowService
{

    public function createProcessFlow(Request $request): bool
    {
        $model = new ProcessFlow();

        if ($model->create($request)) {
            return true;
        }
        return false;
        // $data  = $request->validated();



        // $model = ProcessFlow::create($request);
        // return $model ? true : false;


    }
}
