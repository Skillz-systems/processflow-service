<?php
namespace App\Service;

use App\Models\ProcessFlow;
// use Illuminate\Http\Request;
use App\Http\Requests\CreateProcessFlowServiceRequest;

class ProcessFlowService
{
    public function createProcessFlow(CreateProcessFlowServiceRequest $request): bool
    {
        $model = new ProcessFlow();

        if ($model->create($request)) {
            return true;
        }
        return false;
    }
}
