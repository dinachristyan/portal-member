<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $member_id = session('user_id');
        $selectedMonth = $request->input('bulan'); // Mengambil bulan yang dipilih dari request

        // Fetch profile
        $profile = $this->fetchProfile($member_id);

        // Fetch transactions
        $transactionsResponse = Http::post('http://52.139.219.202:8070/api/get_transaksi_lines', [
            'member_id' => $member_id,
        ]);

        $transactions = $transactionsResponse->json()['result']['data'] ?? [];

        // Filter transaksi berdasarkan bulan yang dipilih
        if ($selectedMonth) {
            $transactions = array_filter($transactions, function ($transaction) use ($selectedMonth) {
                // Mengambil bulan dari tanggal transaksi
                if (isset($transaction['payment_date'])) {
                    $transactionMonth = date('n', strtotime($transaction['payment_date']));
                    return $transactionMonth == $selectedMonth;
                }
                return false;
            });
        }

        // Menghitung total transaksi
        $transactionTotal = array_sum(array_column($transactions, 'amount'));

        // Mengirim data ke view
        return view('pages.transaksi', compact('transactions', 'transactionTotal', 'profile', 'selectedMonth'));
    }

    private function fetchProfile($member_id)
    {
        $profileResponse = Http::post('http://52.139.219.202:8070/api/get_profile', [
            'member_id' => $member_id,
        ]);

        return $profileResponse->json()['result']['data'] ?? [];
    }
}
