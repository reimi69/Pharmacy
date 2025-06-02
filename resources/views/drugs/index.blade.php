@extends('app.layouts.layout')

@section('page_title')
    <b>List of Drugs</b>
@endsection

@section('content')
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">Back to Home</a>
    </div>
    @guest
        <a href="{{ route('login') }}" style="margin-right: 10px;">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @else
        <span>Welcome, {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endguest
    <br><br>
        
    <form method="GET" action="{{ route('drugs.index') }}">
        <div class="mb-4">
            <label for="search" class="mr-2">Search by Name:</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Enter drug name" class="border rounded px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="disease" class="mr-2">Filter by Disease:</label>
            <select name="disease" id="disease">
                <option value="0">All Diseases</option>
                @foreach($diseases as $disease)
                    <option value="{{ $disease }}" {{ $disease == $disease_selected ? 'selected' : '' }}>
                        {{ $disease }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="sort" class="mr-2">Sort by Price:</label>
            <select name="sort" id="sort">
                <option value="">None</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </div>

        <input type="submit" value="Apply Filters" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition" />
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Disease</th>
            <th>Price</th>
            <th>Pharmacy Name</th>
        </tr>
        @forelse ($drugs as $drug)
            <tr>
                <td>
                    <a href="{{ route('drugs.show', $drug->drug_id) }}">
                        {{ $drug->name }}
                    </a>
                </td>
                <td>{{ $drug->count }}</td>
                <td>{{ $drug->disease }}</td>
                <td>{{ $drug->price }}</td>
                <td>
                    <a href="{{ route('pharmacy.show', $drug->pharmacy_id) }}">
                        {{ $drug->pharmacy->pharmacy_name ?? 'Unknown Pharmacy' }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="border p-2 text-center">No drugs found.</td>
            </tr>
        @endforelse
    </table>
    {{ $drugs->links() }}
@endsection