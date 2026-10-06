<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EstimatorController extends Controller
{
    /**
     * Halaman simulasi interaktif Beli Putus vs Sewa Bulanan.
     * Seluruh perhitungan dilakukan di sisi browser (real-time).
     */
    public function index()
    {
        return view('admin.estimator.index', [
            'defaults' => config('pricing.defaults'),
            'slaFeatures' => config('pricing.sla_features'),
        ]);
    }
}
