@extends('admin')

@section('content')
<div class="container">
    <h2>Modifier le produit</h2>

    @if(isset($product))
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image du produit</label>
                <input type="file" name="image" class="form-control">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Image du produit" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    @else
        <p class="text-danger">Erreur : Produit non trouvé.</p>
    @endif
</div>
@endsection
