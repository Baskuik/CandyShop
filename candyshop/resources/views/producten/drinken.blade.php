@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4" style="color:#5a3e85;">Drinken</h2>
    <div class="flex-products">
        @foreach($drinken as $drank)
        <div class="product-card">
            <div class="card transparent-border">
                <img src="{{ asset('images/water.jpg') }}" alt="{{ $drank['naam'] }}" class="product-image">
                <div class="card-body text-center">
                    <h5 class="card-title" style="color:#ff6f61;">{{ $drank['naam'] }}</h5>
                    <p class="card-text" style="font-weight:600; color:#5a3e85;">{{ $drank['prijs'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

