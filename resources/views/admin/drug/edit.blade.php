@extends('admin.layout')

@section('content')
    <h2>Edit Drug</h2>
    @include('admin.drug._form', [
        'action' => route('admin.drugs.update', $drug->drug_id),
        'method' => 'PUT',
        'drug' => $drug,
        'diseases' => $diseases,
        'pharmacies' => $pharmacies
    ])
@endsection