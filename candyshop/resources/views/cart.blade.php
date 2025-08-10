@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4" style="color:#5a3e85;">Winkelwagen</h2>

    @if(session('success'))
        <div style="color:green; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        @foreach($cart as $id => $item)
        <div class="product-card-horizontal" data-id="{{ $id }}" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; border-bottom:1px solid #ddd; padding-bottom:10px;">
            <div>
                <h3 class="product-title">{{ $item['naam'] }}</h3>
                <p>Beschrijving van het product komt hier.</p>
                <p>Extra opties / informatie.</p>
                <div style="display:flex; align-items:center; gap:15px; margin-top:10px;">
                    <div class="product-price" style="font-weight:bold;">
                        €{{ number_format($item['prijs'], 2, ',', '.') }}
                    </div>
                    <div class="quantity-controls" style="display:flex; align-items:center; gap:8px;">
                        @if($item['aantal'] > 1)
                            <button class="quantity-btn decrement-btn" style="background:#5a3e85; color:white; border:none; padding:6px 10px; font-size:1rem; border-radius:4px; cursor:pointer;">−</button>
                        @else
                            <button class="quantity-btn remove-btn decrement-btn" style="background:#ff6f61; color:white; border:none; padding:6px 10px; font-size:1rem; border-radius:4px; cursor:pointer;">🗑</button>
                        @endif
                        <span class="quantity" style="font-weight:bold; min-width:20px; text-align:center;">{{ $item['aantal'] }}</span>
                        <button class="quantity-btn increment-btn" style="background:#5a3e85; color:white; border:none; padding:6px 10px; font-size:1rem; border-radius:4px; cursor:pointer;">+</button>
                    </div>
                </div>
            </div>
            <div>
                <img src="{{ asset('images/water.jpg') }}" alt="{{ $item['naam'] }}" style="width:80px; height:auto; border-radius:8px;">
            </div>
        </div>
        @endforeach
    @else
        <p>Je winkelwagen is leeg.</p>
    @endif

    <form method="POST" action="{{ route('cart.add') }}">
        @csrf
        <button type="submit" style="background:#5a3e85; color:white; padding:10px 20px; border:none; border-radius:6px; cursor:pointer;">
            Voeg product toe (voorbeeld)
        </button>
    </form>

    <div class="discount-code" style="display:flex; gap:10px; margin-top:20px;">
        <input type="text" placeholder="Kortingscode invoeren" style="flex:1; padding:8px; border:1px solid #ddd; border-radius:4px;">
        <button class="apply-discount" style="background:#5a3e85; color:white; border:none; padding:8px 14px; border-radius:4px; cursor:pointer;">Toepassen</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Haal CSRF token uit meta tag in layout
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.increment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.product-card-horizontal');
            const productId = productCard.dataset.id;
            updateQuantity(productId, 'increment', this);
        });
    });

    document.querySelectorAll('.decrement-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.product-card-horizontal');
            const productId = productCard.dataset.id;
            updateQuantity(productId, 'decrement', this);
        });
    });

    function updateQuantity(id, action, button) {
        fetch(`{{ url('cart/update') }}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ action: action })
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response not ok');
            return res.json();
        })
        .then(data => {
            if(data.success) {
                const productCard = button.closest('.product-card-horizontal');
                const quantitySpan = productCard.querySelector('.quantity');
                const decrementBtn = productCard.querySelector('.decrement-btn');

                if(data.aantal > 0) {
                    quantitySpan.textContent = data.aantal;
                    // Als aantal 1, vervang − knop door 🗑
                    if(data.aantal === 1) {
                        decrementBtn.textContent = '🗑';
                        decrementBtn.style.backgroundColor = '#ff6f61';
                    } else {
                        decrementBtn.textContent = '−';
                        decrementBtn.style.backgroundColor = '#5a3e85';
                    }
                } else {
                    // Verwijder product uit DOM als aantal 0
                    productCard.remove();
                    if(document.querySelectorAll('.product-card-horizontal').length === 0) {
                        // Toon lege winkelwagen melding
                        const container = document.querySelector('.container');
                        container.insertAdjacentHTML('beforeend', '<p>Je winkelwagen is leeg.</p>');
                    }
                }
            } else {
                alert('Fout bij bijwerken winkelwagen.');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Er is iets misgegaan.');
        });
    }
</script>
@endsection
