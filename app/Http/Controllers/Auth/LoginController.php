<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = '/home';
    protected $redirectTo = '/admin/layouts/master';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            $this->credentials($request) + ['estado' => 1],
            $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if (!\App\Models\User::where('email', $request->email)->where('estado', 1)->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => [__('Tu cuenta está inactiva o no existe.')],
            ]);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => [__('Estas credenciales no coinciden con nuestros registros.')],
        ]);
    }
}
