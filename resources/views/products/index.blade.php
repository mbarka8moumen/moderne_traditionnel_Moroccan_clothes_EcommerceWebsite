@extends('admin')

@section('content')
    <h1>Liste des Produits</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr id="product-{{ $product->id }}">
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} MAD</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                        <button onclick="deleteProduct({{ $product->id }})" class="btn btn-danger">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('products.create') }}" class="btn btn-primary">Ajouter Produit</a>

    <script>
        function deleteProduct(id) {
            if (confirm('Voulez-vous vraiment supprimer ce produit ?')) {
                // Envoi de la requête AJAX
                fetch(`/admin/products/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Supprimer la ligne du tableau
                        document.getElementById(`product-${id}`).remove();
                        alert('Produit supprimé avec succès.');
                    } else {
                        alert('Une erreur est survenue.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });
            }
        }
    </script>
@endsection
