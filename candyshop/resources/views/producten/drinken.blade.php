@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4" style="color:#5a3e85;">Drinken</h2>
    <div class="flex-products">
        @foreach($drinken as $drank)
        <div class="product-card-horizontal">
            <div class="product-info">
                <h3 class="product-title">{{ $drank['naam'] }}</h3>
                <p class="product-description">
                    Romige melk met heerlijke smaak. Afgetopt met toppings naar keuze.
                </p>
                <p class="product-extra">
                    Kies uit: <em>Medium, Large 700ml, Holo Cup, Diverse toppings en meer.</em>
                </p>
                <div class="product-price">{{ $drank['prijs'] }}</div>
            </div>
            <div class="product-image-container">
                <img src="{{ asset('images/water.jpg') }}" alt="{{ $drank['naam'] }}" class="product-image">
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
