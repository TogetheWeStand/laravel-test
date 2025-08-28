<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class ApiBasicAuth
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return ContractsApplication|ResponseFactory|Application|Response|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $email = $request->getUser();
        $password = $request->getPassword();

        if (!$email || !$password) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
        }

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
        }

        // авторизованный пользователь будет доступен через $request->user()
        $request->setUserResolver(fn() => $user);

        return $next($request);
    }
}
