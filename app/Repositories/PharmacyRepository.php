<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Collection;

class PharmacyRepository
{
    public function getAll(): Collection
    {
        return Pharmacy::select('pharmacy_id', 'pharmacy_name', 'street')
            ->orderBy('pharmacy_name')
            ->get();
    }

    public function findOrFail(int $id): Pharmacy
    {
        return Pharmacy::with('drugs')->findOrFail($id);
    }
}