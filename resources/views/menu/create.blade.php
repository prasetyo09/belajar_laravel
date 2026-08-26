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
                    <form action="{{ route('menu.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Parent</label>
                                <select name="parent_id" id="" class="form-select">
                                    <option value="">-- Select Parent --</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Icon</label>
                                <input type="text" name="icon" id="icon" class="form-control" placeholder="Enter Icon">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">URL</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Enter URL">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Status</label>
                                <div class="card w-25 shadow-sm">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" id="is_active" value="1" checked>
                                            <label class="form-check-label" for="is_active">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" id="is_active" value="0">
                                            <label class="form-check-label" for="is_active">
                                                Non-Active
                                            </label>
                                        </div>
                                    </div>
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
