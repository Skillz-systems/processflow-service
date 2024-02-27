<?php
namespace App\Service;

use App\Models\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteService
{
    /**
     * Create a new route.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\MessageBag|array
     */

    public function createRoute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'link' => 'required|string',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $model = new Routes();
        return $model->create($request->all());
    }

}
