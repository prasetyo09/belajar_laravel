@extends('app')
@section('content')
<div class="table table-responsive">
    <div class="d-flex justify-content-end">
        <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">Create Role</a>
    </div>
    <table class="table table-hover table-bordered" id="myTable">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $roles as $index => $v )
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $v->name }}</td>
                <td class="text-center {{ $v->is_active == 1 ? 'text-success' : 'text-danger' }}">{{ $v->is_active == 1 ? 'Active' : 'Non-Active' }}</td>
                <td class="text-center">
                    <a href="{{ route('role.edit', $v->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('role.destroy', $v->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
