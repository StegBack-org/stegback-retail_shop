<?php

namespace Stegback\RetailShop\Services;

use Illuminate\Support\Facades\Auth;
use Stegback\RetailShop\Models\Store;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $credentials): bool
    {
        return Auth::guard('stores')->attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('stores')->logout();
    }

    public function resetPassword($request): void
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $store = Store::where('email', $request->email)
            ->where('password_reset_token', $request->token)
            ->first();

        if (!$store) {
            throw new \InvalidArgumentException('Invalid token or email.');
        }

        $store->password = bcrypt($request->password);
        $store->password_reset_token = null;
        $store->save();
    }

    public function isStegbackUser(): bool
    {
        return Auth::check() && (Auth::user()->type == 'Admin' || Auth::user()->type == 'SuperAdmin');
    }

    public function isLoggedInStore(): bool
    {
        return auth('stores')->check() && auth('stores')->user()->role == 'store';
    }
}
