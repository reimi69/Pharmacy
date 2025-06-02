<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Repositories\DrugRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DrugController extends Controller
{
    protected DrugRepository $drugRepository;

    public function __construct(DrugRepository $drugRepository)
    {
        $this->drugRepository = $drugRepository;
    }

    public function index(Request $request): View
    {
         $filters = [
            'search' => $request->input('search'),
            'disease' => $request->input('disease', 0),
        ];
        $sort = $request->input('sort');

        $drugs = $this->drugRepository->getAll($filters, $sort);
        $diseases = $this->drugRepository->getDistinctDiseases();
        $disease_selected = $request->input('disease', 0);

        return view('drugs.index', compact('drugs', 'diseases', 'disease_selected'));
    }

    public function show(int $drug_id): View
    {
        $drug = $this->drugRepository->findOrFail($drug_id);
        return view('drugs.show', compact('drug'));
    }
}