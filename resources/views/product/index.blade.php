@extends('app')
@section('content')
<div class="table table-responsive">
    <div class="d-flex justify-content-end">
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Create</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Category Name</th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Description</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $products as $index => $v )
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $v->category->name }}</td>
                <td class="text-center">{{ $v->name }}</td>
                <td class="text-center">{{ $v->price }}</td>
                <td class="text-center">{{ $v->description }}</td>
                <td class="text-center">
                    <a href="{{ route('product.edit', $v->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('product.destroy', $v->id) }}" method="post" class="d-inline">
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
