<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $member_id = session('user_id');

        // Fetch profile data
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);

        $profile = $profileResponse->json()['result']['data'] ?? [];

        // Pass the profile data to the view
        return view('pages.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        // Get the member_id from session
        $member_id = session('user_id');
        
        // Prepare data for the API request
        $data = [
            'member_id' => $member_id,
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            // 'emergency_contact' => $request->input('emergency_contact'),
            // 'npwp' => $request->input('npwp'),
            // 'address' => $request->input('address')
        ];
        
        // Call the API to update the profile
        $response = Http::post('http://52.139.219.202:8070/api/update_profile', $data);

        // Check if the update was successful
        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update profile.']);
        }
    }
}
