@extends('app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting.update', $settings->id == 1) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Hero</label>
                            <input type="text" name="hero" id="hero" class="form-control" value="{{ $settings->hero ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $settings->title ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">POS Title</label>
                            <input type="text" name="pos_title" id="pos_title" class="form-control" value="{{ $settings->pos_title ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Business Name</label>
                            <input type="text" name="business_name" id="business_name" class="form-control" value="{{ $settings->business_name ?? '' }}">
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
