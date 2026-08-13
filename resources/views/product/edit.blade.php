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
                        <form action="{{ route('product.update', $products->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    @foreach ($categories as $v)
                                        <option {{ $products->category_id == $v->id ? 'selected' : '' }} value="{{ $v->id }}">
                                            {{ $v->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $products->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    value="{{ $products->price }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold">Description</label>
                                <textarea name="description" id="description"
                                    class="form-control">{{ $products->description }}</textarea>
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
