<div class="card-product">
    <div class="card">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-price">Bs. {{ number_format($product->price, 2) }}</p>
            <p class="card-stock">Stock: {{ $product->stock }} unidades</p>

            <div class="d-flex justify-content-between">
                <button class="btn btn-primary">Agregar al carrito</button>
                <button class="btn btn-warning">Añadir a favoritos</button>
            </div>
        </div>
    </div>
</div>
