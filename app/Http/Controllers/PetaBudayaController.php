<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use Illuminate\Http\Request;

class PetaBudayaController extends Controller
{
    private $provinceCoordinates = [
        'Aceh' => [4.6951, 96.7494],
        'Sumatera Utara' => [2.1154, 99.5451],
        'Sumatera Barat' => [-0.7397, 100.8000],
        'Riau' => [0.2933, 101.7068],
        'Jambi' => [-1.4852, 102.4380],
        'Sumatera Selatan' => [-3.3194, 103.9144],
        'Bengkulu' => [-3.5778, 102.3464],
        'Lampung' => [-4.5586, 105.4068],
        'Bangka Belitung' => [-2.4961, 106.4396],
        'Kepulauan Riau' => [3.9456, 108.1429],
        'DKI Jakarta' => [-6.2088, 106.8456],
        'Jawa Barat' => [-6.9147, 107.6098],
        'Jawa Tengah' => [-7.1509, 110.1403],
        'DI Yogyakarta' => [-7.7956, 110.3695],
        'Jawa Timur' => [-7.5361, 112.2384],
        'Banten' => [-6.4058, 106.0640],
        'Bali' => [-8.3405, 115.0920],
        'Nusa Tenggara Barat' => [-8.6529, 117.3616],
        'Nusa Tenggara Timur' => [-8.6574, 121.0794],
        'Kalimantan Barat' => [-0.2788, 111.4753],
        'Kalimantan Tengah' => [-1.6815, 113.3824],
        'Kalimantan Selatan' => [-3.0926, 115.2838],
        'Kalimantan Timur' => [0.5389, 116.4194],
        'Kalimantan Utara' => [3.0738, 116.0414],
        'Sulawesi Utara' => [0.6247, 123.9750],
        'Sulawesi Tengah' => [-1.4300, 121.4456],
        'Sulawesi Selatan' => [-3.6688, 119.9741],
        'Sulawesi Tenggara' => [-3.5491, 121.7270],
        'Gorontalo' => [0.6999, 122.4467],
        'Sulawesi Barat' => [-2.8441, 119.2321],
        'Maluku' => [-3.2385, 130.1453],
        'Maluku Utara' => [1.5709, 127.8088],
        'Papua Barat' => [-1.3361, 133.1747],
        'Papua' => [-4.2699, 138.0804]
    ];

    public function index()
    {
        $contents = Konten::where('status', 'approved')
            ->with(['akun' => function($query) {
                $query->select('id', 'username');
            }])
            ->get(['id', 'thumbnail', 'judul', 'isi', 'kategori', 'asal', 'akun_id', 'views_count', 'created_at']);

        return view('user.petabudaya', [
            'contents' => $contents,
            'provinceCoordinates' => $this->provinceCoordinates
        ]);
    }

    public function show($id)
    {
        $content = Konten::with(['akun' => function($query) {
                $query->select('id', 'username');
            }])
            ->findOrFail($id, ['id', 'thumbnail', 'judul', 'isi', 'kategori', 'asal', 'akun_id', 'views_count', 'created_at']);

        $content->increment('views_count');

        return view('layouts.content-modal', compact('content'));
    }
}
