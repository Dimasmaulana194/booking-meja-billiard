<?php

namespace App\Http\Controllers;

use App\Models\Meja;  // Pastikan model Meja di-import
use Illuminate\Http\Request;

class MejaRegularController extends Controller
{
    /**
     * Menampilkan halaman Meja Regular.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data meja dengan asal 'regular'
        $mejas = Meja::where('asal', 'regular')->get();
        return view('mejaregular', compact('mejas')); // Mengirim data meja ke view
    }
}
