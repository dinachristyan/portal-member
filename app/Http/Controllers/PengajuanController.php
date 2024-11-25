<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    // Method untuk menampilkan semua data pengajuan
    public function pengajuan()
    {
        // Mengatur data pengajuan menjadi kosong jika tidak ada
        $pengajuans = [];  // Atau ambil data dari sumber lain yang mungkin kosong

        // Mengembalikan view dengan data pengajuan
        return view('pages.pengajuan', compact('pengajuans'));
    }
}
