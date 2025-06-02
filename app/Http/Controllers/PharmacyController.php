<?php

namespace App\Http\Controllers;

use App\Repositories\PharmacyRepository;
use Illuminate\View\View;

class PharmacyController extends Controller
{
     protected PharmacyRepository $pharmacyRepository;

    public function __construct(PharmacyRepository $pharmacyRepository)
    {
        $this->pharmacyRepository = $pharmacyRepository;
    }

    public function show(int $pharmacy_id): View
    {
        $pharmacy = $this->pharmacyRepository->findOrFail($pharmacy_id);
        $drugs = $pharmacy->drugs;

        return view('pharmacy', compact('pharmacy', 'drugs'));
    }
}