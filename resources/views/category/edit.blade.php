@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end">
                <a href="{{ url('category') }}" class="btn btn-primary mb-3"><-Back</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.update', $categories->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $categories->name }}">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active1" {{ $categories->is_active == 1 ? 'checked' : '' }} value="1">
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active2" {{ $categories->is_active == 0 ? 'checked' : '' }} value="0">
                                <label class="form-check-label" for="is_active">
                                    Non-Active
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
