<?php

namespace App\Http\Controllers;

use App\Models\Meja;  // Pastikan model Meja di-import
use Illuminate\Http\Request;

class MejaVIPController extends Controller
{
    /**
     * Menampilkan halaman Meja VIP.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mejas = Meja::where('asal', 'vip')->get();
        return view('mejavip', compact('mejas')); // ganti 'meja-vip' → 'mejavip'
    }
    

}
