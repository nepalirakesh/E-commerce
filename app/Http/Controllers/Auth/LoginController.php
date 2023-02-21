<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Middleware;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;

class LoginController extends Controller
{
    protected $cartService;
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartService $cartService)
    {
                $this->cartService = $cartService;

        // $this->middleware('guest')->except('logout');
        $this->Middleware('guest', ['except' => ['logout', 'userLogout']]);
    }
    public function userLogout()
    {
     $this->cartService->clear();
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}