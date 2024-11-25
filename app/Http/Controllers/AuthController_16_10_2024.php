<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // Login method
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Make an API request to Odoo's login route
        $response = Http::post('http://192.168.23.132:8069/api/portal_login', [
            'username_portal' => $request->username,
            'password_portal' => $request->password,
        ]);

        // Check if the response was successful
        if ($response->successful()) {
            $data = $response->json();

            // Check if 'status' exists and is 'success'
            if (isset($data['status']) && $data['status'] === 'success') {
                // Store member_id in the session
                session(['member_id' => $data['member_id']]);

                // Redirect to home with success message
                return redirect()->route('home')->with('success', 'Login successful!');
            } else {
                // Failed login logic
                return back()->withErrors(['message' => $data['message'] ?? 'Invalid username or password']);
            }
        } else {
            // Handle API call failure
            return back()->withErrors(['message' => 'Failed to connect to Odoo API']);
        }
    }

    // Reset password method
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'new_password' => 'required',
        ]);

        $response = Http::post('http://192.168.23.132:8069/api/reset_password', [
            'username' => $request->username,
            'new_password' => $request->new_password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return back()->with('success', $data['message'] ?? 'Password reset successful!');
        } else {
            return back()->withErrors(['message' => 'Failed to connect to Odoo API']);
        }
    }

    // Register method
    public function register(Request $request)
    {
        $request->validate([
            'nrp' => 'required',
            'password' => 'required',
            'username' => 'nullable',
        ]);

        $response = Http::post('http://192.168.23.132:8069/api/register', [
            'nrp' => $request->nrp,
            'password' => $request->password,
            'username' => $request->username,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return back()->with('success', $data['message'] ?? 'Registration successful!');
        } else {
            return back()->withErrors(['message' => 'Failed to connect to Odoo API']);
        }
    }

    // Get Value Transactions
    public function getValueTransactions(Request $request)
    {
        $member_id = session('member_id'); // Get member_id from session

        $response = Http::post('http://192.168.23.132:8069/api/get_transaksi_lines', [
            'member_id' => $member_id,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data['data'] ?? []);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to connect to Odoo API']);
        }
    }

    // Get Value Pinjaman
    public function getValuePinjaman(Request $request)
    {
        $member_id = session('member_id'); // Get member_id from session

        $response = Http::post('http://192.168.23.132:8069/api/get_tagihan_lines', [
            'member_id' => $member_id,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data['data'] ?? []);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to connect to Odoo API']);
        }
    }

    // Get Value Tabungan Qurban
    public function getValueTabunganQurban(Request $request)
    {
        $member_id = session('member_id'); // Get member_id from session

        $response = Http::post('http://192.168.23.132:8069/api/get_taqur_lines', [
            'member_id' => $member_id,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data['data'] ?? []);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to connect to Odoo API']);
        }
    }
}
