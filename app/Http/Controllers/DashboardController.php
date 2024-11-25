<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function transaksi(Request $request)
    {
        $member_id = session('user_id');

        // Fetch profile details
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);

        $profile = $profileResponse->json()['result']['data'] ?? [];

        // Fetch transaction details
        $transactionsResponse = Http::post('http://52.139.219.202:8070/api/get_transaksi_lines', [
            'member_id' => $member_id,
        ]);

        $transactions = $transactionsResponse->json()['result']['data'] ?? [];
        $transactionTotal = array_sum(array_column($transactions, 'amount'));

        return view('pages.transaksi', compact('transactions', 'transactionTotal', 'profile'));
    }

    public function pinjaman(Request $request)
    {
        $member_id = session('user_id');

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
        $loanTotal = array_sum(array_column($loans, 'amount'));

        return view('pages.pinjaman', compact('loans', 'loanTotal', 'profile'));
    }

    // public function simpanan(Request $request)
    // {
    //     $member_id = session('user_id');

    //     // Fetch savings details
    //     $savingsResponse = Http::post('http://52.139.219.202:8070/api/get_simpanan', [
    //         'member_id' => $member_id,
    //     ]);

    //     $savings = $savingsResponse->json()['result']['data'] ?? [];
    //     $savingTotal = array_sum(array_column($savings, 'amount'));

    //     return view('pages.simpanan', compact('savings', 'savingTotal'));
    // }

    public function simpanan(Request $request)
    {
        $member_id = session('user_id');
        $jenis_tagihan = $request->input('jenis_tagihan', ''); // Get filter value, default is empty

        // Fetch profile details
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);

        $profile = $profileResponse->json()['result']['data'] ?? [];

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

        // Calculate total amount of savings
        $savingTotal = array_sum(array_column($savings, 'amount'));

        // Get distinct types of "jenis_tagihan" for dropdown options
        $jenisTagihanOptions = array_unique(array_column($savings, 'jenis_tagihan'));

        return view('pages.simpanan', compact('savings', 'savingTotal', 'jenisTagihanOptions', 'jenis_tagihan', 'profile'));
    }


    public function tabunganQurban(Request $request)
    {
        $member_id = session('user_id');

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
        $qurbanTotal = array_sum(array_column($qurbanSavings, 'nominal'));

        return view('pages.tabungan-qurban', compact('qurbanSavings', 'qurbanTotal', 'profile'));
    }

    public function index(Request $request)
    {
        $member_id = session('user_id');

        // Fetch profile details
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);

        $profile = $profileResponse->json()['result']['data'] ?? [];

        // Fetch transaction details
        $transactionsResponse = Http::post('http://52.139.219.202:8070/api/get_transaksi_lines_month', [
            'member_id' => $member_id,
        ]);

        $transactions = $transactionsResponse->json()['result']['data'] ?? [];
        $transactionTotal = array_sum(array_column($transactions, 'amount'));

        // Fetch loan details
        $loansResponse = Http::post('http://52.139.219.202:8070/api/get_tagihan_lines', [
            'member_id' => $member_id,
        ]);

        $loans = $loansResponse->json()['result']['data'] ?? [];
        $loanTotal = array_sum(array_column($loans, 'amount'));

        // Fetch saving details
        $savingsResponse = Http::post('http://52.139.219.202:8070/api/get_simpanan_month', [
            'member_id' => $member_id,
        ]);

        $savings = $savingsResponse->json()['result']['data'] ?? [];
        $savingTotal = array_sum(array_column($savings, 'amount'));

        // Fetch Qurban savings details
        $qurbanResponse = Http::post('http://52.139.219.202:8070/api/get_taqur_lines', [
            'member_id' => $member_id,
        ]);

        $qurbanSavings = $qurbanResponse->json()['result']['data'] ?? [];
        $qurbanTotal = array_sum(array_column($qurbanSavings, 'nominal'));

        // Pass data to the view
        return view('dashboard', compact(
            'transactions',
            'transactionTotal',
            'loans',
            'loanTotal',
            'savings',
            'savingTotal',
            'qurbanSavings',
            'qurbanTotal',
            'profile' // Pass profile data to the view
        ));
    }
}
