<?php

namespace App\Http\Controllers\Sensei;

use App\Http\Controllers\Controller;

class EvaluasiController extends Controller
{
    public function index()
    {
        return view('sensei.evaluasi.index');
    }

    public function detailSiswaSeleksi($id = null)
    {
        return view('sensei.evaluasi.detail.siswa.seleksi');
    }
}
