@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end">
                <a href="{{ url('product') }}" class="btn btn-primary mb-3"><-Back</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label fw-bold">Category</label>
                                <input type="text" name="category_id" id="" class="form-control" value="{{ $products->category->name }}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="" class="form-control" value="{{ $products->name }}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label fw-bold">Price</label>
                                <input type="text" name="price" id="" class="form-control" value="Rp.{{ number_format($products->price) }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <label for="" class="form-label fw-bold">Description</label>
                                <textarea name="description" id="description" class="form-control" readonly>{{ $products->description }}</textarea>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column align-items-center">
                                <h3 class="fw-bold form-label">Product Photo</h3>
                                <img src="{{ asset('storage/' . $products->photo) }}" alt="Product Picture" class="shadow rounded-5 border border-dark">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
