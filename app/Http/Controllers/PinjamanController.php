<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PinjamanController extends Controller
{
    public function pinjaman(Request $request)
    {
        $member_id = session('user_id');
        $selectedMonth = $request->input('bulan'); // Filter bulan yang dipilih

        // Fetch profile details
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);
        $profile = $profileResponse->json()['result']['data'] ?? [];

        // Fetch loan details
        $loansResponse = Http::post('http://52.139.219.202:8070/api/get_tagihan_lines', [
            'member_id' => $member_id,
        ]);
        $loans = $loansResponse->json()['result']['data'] ?? [];

        // Filter by month if provided
        if ($selectedMonth) {
            $loans = array_filter($loans, function ($loan) use ($selectedMonth) {
                // Extract month from the date
                $loanMonth = date('n', strtotime($loan['date']));
                return $loanMonth == $selectedMonth;
            });
        }

        // Calculate total amount of loans
        $loanTotal = array_sum(array_column($loans, 'amount'));

        return view('pages.pinjaman', compact('loans', 'loanTotal', 'profile', 'selectedMonth'));
    }
}
