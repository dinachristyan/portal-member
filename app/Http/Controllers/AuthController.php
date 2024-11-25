<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Redirect to dashboard if already logged in
        if (session()->has('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Make an API request to Odoo's login route
        $response = Http::post('http://52.139.219.202:8070/api/portal_login', [
            'username_portal' => $request->username,
            'password_portal' => $request->password,
        ]);

        // Check if the response was successful
        if ($response->successful()) {
            $data = $response->json();

            // Check if 'status' exists and is 'success'
            if (isset($data['result']['status']) && $data['result']['status'] === 'success') {
                // Store user_id in the session
                session(['user_id' => $data['result']['member_id']]);
                // Redirect to the dashboard with a success message
                return redirect()->route('dashboard')->with('success', 'Login successful!');
            } else {
                // Failed login logic
                return back()->withErrors(['message' => $data['result']['message'] ?? 'Invalid username or password']);
            }
        } else {
            // Handle API call failure
            return back()->withErrors(['message' => 'Failed to connect to Odoo API']);
        }
    }

    
    /**
     * Show the register form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Redirect to dashboard if already logged in
        if (session()->has('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }


    /**
     * Handle user registration.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        // Make an API request to register the user in Odoo
        $response = Http::post('http://52.139.219.202:8070/api/register', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        // Check if the response was successful
        if ($response->successful()) {
            $data = $response->json();

            // Check if registration was successful
            if (isset($data['result']['status']) && $data['result']['status'] === 'success') {
                return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
            } else {
                return back()->withErrors(['message' => $data['result']['message'] ?? 'Registration failed.']);
            }
        }

        return back()->withErrors(['message' => 'Failed to connect to Odoo API']);
    }

    /**
     * Handle logout functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Invalidate the session to log out the user
        $request->session()->invalidate();

        // Regenerate the CSRF token for security
        $request->session()->regenerateToken();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Logout successful!');
    }

    /**
     * Show the forgot password form.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle the forgot password request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPassword(Request $request)
    {
        // Validate input, ensuring password and password_confirmation match
        $request->validate([
            'nrp' => 'required|string',
            'password' => 'required|string|confirmed', // 'confirmed' ensures the password confirmation matches
        ]);

        // Get the NRP and new password from the request
        $nrp = $request->input('nrp');
        $newPassword = $request->input('password');

        // Make the API request to reset the password
        $response = Http::post('http://52.139.219.202:8070/api/reset_password', [
            'username' => $nrp,
            'new_password' => $newPassword,
        ]);

        // Check if the response is successful
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Password updated successfully!');
        } else {
            return redirect()->back()->withErrors('Failed to update password.');
        }
    }


}
