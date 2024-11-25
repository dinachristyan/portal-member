<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Simpanan;

class SimpananController extends Controller
{

    public function simpanan(Request $request)
    {
        $member_id = session('user_id');
        $jenis_tagihan = $request->input('jenis_tagihan', ''); // Get filter value, default is empty
        $selectedMonth = $request->input('bulan'); // Filter bulan yang dipilih

        // Fetch savings details
        $savingsResponse = Http::post('http://52.139.219.202:8070/api/get_simpanan', [
            'member_id' => $member_id,
        ]);

        $savings = $savingsResponse->json()['result']['data'] ?? [];

        // Filter by jenis_tagihan if provided
        if (!empty($jenis_tagihan)) {
            $savings = array_filter($savings, function ($saving) use ($jenis_tagihan) {
                return $saving['jenis_tagihan'] === $jenis_tagihan;
            });
        }

        // Filter by month if provided
        if ($selectedMonth) {
            $savings = array_filter($savings, function ($saving) use ($selectedMonth) {
                // Extract month from the date
                $savingMonth = date('n', strtotime($saving['date']));
                return $savingMonth == $selectedMonth;
            });
        }

        // Calculate total amount of savings
        $savingTotal = array_sum(array_column($savings, 'amount'));

        // Get distinct types of "jenis_tagihan" for dropdown options
        $jenisTagihanOptions = array_unique(array_column($savings, 'jenis_tagihan'));

        return view('pages.simpanan', compact('savings', 'savingTotal', 'jenisTagihanOptions', 'jenis_tagihan', 'selectedMonth'));
    }
}
