@extends('admin')

@section('content')
    <h1>Are you sure you want to delete this product?</h1>
    <p><strong>{{ $product->name }}</strong></p>

    <!-- Formulaire de confirmation de suppression -->
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Yes, delete it</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
