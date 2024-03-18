<?php

namespace Stegback\RetailShop\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stegback\RetailShop\Services\AuthService;

class StoreAuth extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginView()
    {
        // $this->tempLoginAsStegback();

        if ($this->authService->isStegbackUser()) {
            return redirect()->route('RetailShop.admin-dashboard');
        }

        if ($this->authService->isLoggedInStore()) {
            return redirect()->route('RetailShop.store-dashboard', [
                'store' => auth('stores')->user()->storeName,
                'i' => base64_encode(auth('stores')->user()->id)
            ]);
        }

        return view('RetailShop::auth.login_view');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->authService->login($credentials)) {
            return redirect()->route('RetailShop.store-dashboard', [
                'store' => auth('stores')->user()->storeName,
                'i' => base64_encode(auth('stores')->user()->id)
            ]);
        }

        return redirect()->back()->withInput()->withErrors(['errors' => 'Invalid email or password']);
    }


    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('RetailShop.loginView');
    }


    public function password_reset(Request $request)
    {
        $token = $request->input('token');
        return view('RetailShop::dashboard.password-form', compact('token'));
    }

    public function reset(Request $request)
    {
        $this->authService->resetPassword($request);
        return redirect()->route('RetailShop.loginView');
    }

    protected function tempLoginAsStegback()
    {
        $email = 'kartik@stegpearl.com';
        $password = 'stegpearl@123';
        Auth::attempt(['email' => $email, 'password' => $password]);
        auth()->loginUsingId(1);
        return true;
    }
}
