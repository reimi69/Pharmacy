@extends('admin.layout')

@section('content')
    <h2>Add Drug</h2>
    @include('admin.drug._form', [
        'action' => route('admin.drugs.store'),
        'drug' => new \App\Models\Drug(),
        'diseases' => $diseases,
        'pharmacies' => $pharmacies
    ])
@endsection