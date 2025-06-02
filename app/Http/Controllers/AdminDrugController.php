<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Repositories\DrugRepository;
use App\Repositories\PharmacyRepository;
use App\Services\DrugService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDrugController extends Controller
{
    protected DrugRepository $drugRepository;
    protected PharmacyRepository $pharmacyRepository;
    protected DrugService $drugService;

    public function __construct(
        DrugRepository $drugRepository,
        PharmacyRepository $pharmacyRepository,
        DrugService $drugService
    ) {
        $this->drugRepository = $drugRepository;
        $this->pharmacyRepository = $pharmacyRepository;
        $this->drugService = $drugService;
    }

    public function index(): View
    {
        $drugs = $this->drugRepository->getAll();
        return view('admin.drug.list', compact('drugs'));
    }

    public function create(): View
    {
        $pharmacies = $this->pharmacyRepository->getAll();
        $diseases = $this->drugRepository->getDistinctDiseases();
        return view('admin.drug.add', compact('pharmacies', 'diseases'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->drugService->validate($request);
        $this->drugRepository->create($data);

        return redirect()->route('admin.drugs.index')->with('success', 'Drug created successfully');
    }   

    public function edit(int $id): View
    {
        $drug = $this->drugRepository->findOrFail($id);
        $diseases = $this->drugRepository->getDistinctDiseases();
        $pharmacies = $this->pharmacyRepository->getAll();

        return view('admin.drug.edit', compact('drug', 'diseases', 'pharmacies'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
         $data = $this->drugService->validate($request);
        $drug = $this->drugRepository->findOrFail($id);
        $this->drugRepository->update($drug, $data);
        return redirect()->route('admin.drugs.index')->with('success', 'Drug updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->drugRepository->delete($id);
        return redirect()->route('admin.drugs.index')->with('success', 'Drug deleted successfully');
    }
}