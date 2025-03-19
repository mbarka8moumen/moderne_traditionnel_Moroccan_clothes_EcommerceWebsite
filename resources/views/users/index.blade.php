@extends('admin')

@section('content')
<div class="container">
    <h1>Gestion des utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Ajouter un utilisateur</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td><span class="status {{ $user->status == 'Active' ? 'active' : 'inactive' }}">{{ $user->status }}</span></td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
