@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end">
                <a href="{{ url('menu') }}" class="btn btn-primary mb-3"><i class="bi bi-arrow-left"></i>Back</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('menu.update', $menus->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $menus->name }}" >
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Parent</label>
                                <select name="parent_id" id="" class="form-select">
                                    <option value="">-- Select Parent --</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Icon</label>
                                <input type="text" name="icon" id="icon" class="form-control" value="{{ $menus->icon }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">URL</label>
                                <input type="text" name="url" id="url" class="form-control" value="{{ $menus->url }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ $menus->sort_order }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="is_active1" {{ $menus->is_active == 1 ? 'checked' : '' }} value="1">
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="is_active2" {{ $menus->is_active == 0 ? 'checked' : '' }} value="0">
                                    <label class="form-check-label" for="is_active">
                                        Non-Active
                                    </label>
                                </div>
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
