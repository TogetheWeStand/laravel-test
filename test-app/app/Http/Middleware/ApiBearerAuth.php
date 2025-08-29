<?php

namespace App\Http\Middleware;

use App\Interfaces\IBearerAuthenticableModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Exception;

class ApiBearerAuth
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string $modelClass
     * @return ContractsApplication|ResponseFactory|Application|Response|mixed
     * @throws Exception
     */
    public function handle(Request $request, Closure $next, string $modelClass): mixed
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Bearer']);
        }

        $model = new $modelClass;

        if (!($model instanceof IBearerAuthenticableModel)) {
            throw new Exception('Model class must be an instance of IBearerAuthenticableModel');
        }

        $foundModel = $model::where($model->getBearerTokenFieldName(), $token)->first();

        if (!$foundModel) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Bearer']);
        }

        return $next($request);
    }
}
