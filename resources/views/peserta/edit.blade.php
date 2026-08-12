@extends('app')
@section('content')
<div class="d-flex justify-content-end">
    <a href="{{ url('peserta') }}" class=" btn btn-outline-primary">Kembali</a>
</div>
<form action="{{ route('update-peserta', $peserta->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label fw-bold">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $peserta->name }}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label fw-bold">Email</label>
        <input type="email  " name="email" id="email" class="form-control" value="{{ $peserta->email }}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label fw-bold">Age</label>
        <input type="number" name="age" id="age" class="form-control" value="{{ $peserta->age }}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label fw-bold">Address</label>
        <textarea name="address" id="address" class="form-control">{{ $peserta->address }}</textarea>
    </div>
    <div class="mb-3">
        <button type="submit" name="save" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-outline-primary">Reset</button>
    </div>
</form>
@endsection
