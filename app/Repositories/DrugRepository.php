<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DrugRepository
{
   public function getAll(array $filters = [], ?string $sort = null): LengthAwarePaginator
    {
        $query = Drug::query();

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['disease']) && $filters['disease'] !== '0') {
            $query->where('disease', $filters['disease']);
        }

        if ($sort === 'asc' || $sort === 'desc') {
            $query->orderBy('price', $sort);
        }

        return $query->with('pharmacy')->paginate(10);
    }

    public function findOrFail(int $id): Drug
    {
        return Drug::with('pharmacy')->findOrFail($id);
    }

    public function getDistinctDiseases(): Collection
    {
        return Drug::distinct()->pluck('disease')->sort();
    }

    public function create(array $data): Drug
    {
        return Drug::create($data);
    }

    public function update(Drug $drug, array $data): bool
    {
        return $drug->update($data);
    }

    public function delete(int $id): void
    {
        Drug::destroy($id);
    }
}
