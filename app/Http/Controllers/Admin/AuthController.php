<?php

// AuthController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function showLoginForm()
    {
        // Check if user is already authenticated
        if (Auth::guard('admin')->check()) {
            // If authenticated, redirect to the dashboard
            return redirect()->route('admin.home.index');
        } else if(Auth::guard('web')->check()) {
            return redirect()->route('home.index');
        }

        // Show the login form
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login request
        $this->validateLogin($request);

        // Attempt to log in the user
        if ($this->attemptLogin($request)) {
            // Check if the user has the required role
            $user = Auth::guard('admin')->user();
            if ($user && $user->role_id == 1) {
                // Redirect to the dashboard if the user has the required role
                return redirect()->route('admin.home.index');
            } else {
                // If the user does not have the required role, logout and show a message
                Auth::guard('admin')->logout();
                return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'You do not have the required role to log in.');
            }
        }

        // If login attempt fails, redirect back with error message
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Invalid password or email.');
    }

    protected function validateLogin(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        // Attempt to log in the user
        return Auth::guard('admin')->attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        );
    }

    // Logout
    public function logout()
    {
        // Logout the user
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
