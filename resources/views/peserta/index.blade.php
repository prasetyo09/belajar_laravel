@extends('app')
@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('create-peserta') }}" class="btn btn-primary">Tambah Peserta</a>
</div>
<table class="table table-bordered mb-3">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Email</th>
            <th class="text-center">Umur</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pesertas as $index => $v)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td class="text-center">{{ $v->name }}</td>
            <td class="text-center">{{ $v->email }}</td>
            <td class="text-center">{{ $v->age }}</td>
            <td class="text-center">{{ $v->address }}</td>
            <td class="text-center">
                <a href="" class="btn btn-success">Edit</a>
                <a href="" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
