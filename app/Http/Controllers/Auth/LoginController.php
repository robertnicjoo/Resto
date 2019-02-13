<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated($request, $user)
    {
        if($user->hasRole('Admin'))
        {
            return redirect('/backoffice/dashboard');
        } elseif($user->hasRole('Cashier')) {
            return redirect('/backoffice/orders/create');
        } else {
            return redirect('/');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
