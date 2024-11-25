<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TabunganController extends Controller
{
    public function tabunganQurban(Request $request)
    {
        $member_id = session('user_id');
        $selectedMonth = $request->input('bulan'); // Filter bulan yang dipilih

        // Fetch profile details
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);
        $profile = $profileResponse->json()['result']['data'] ?? [];

        // Fetch Qurban savings details
        $qurbanResponse = Http::post('http://52.139.219.202:8070/api/get_taqur_lines', [
            'member_id' => $member_id,
        ]);
        $qurbanSavings = $qurbanResponse->json()['result']['data'] ?? [];

        // Filter by month if provided
        if ($selectedMonth) {
            $qurbanSavings = array_filter($qurbanSavings, function ($saving) use ($selectedMonth) {
                // Extract month from the date
                $savingMonth = date('n', strtotime($saving['tanggal']));
                return $savingMonth == $selectedMonth;
            });
        }

        // Calculate total nominal for qurban savings
        $qurbanTotal = array_sum(array_column($qurbanSavings, 'nominal'));

        return view('pages.tabungan-qurban', compact('qurbanSavings', 'qurbanTotal', 'profile', 'selectedMonth'));
    }
}
