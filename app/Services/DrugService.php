<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DrugService
{
    public function validate(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'count' => 'required|integer|min:0',
            'disease' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'pharmacy_id' => 'required|exists:pharmacies,pharmacy_id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}