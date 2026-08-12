@extends('app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end">
                <a href="{{ url('role') }}" class="btn btn-primary mb-3"><-Back</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold">Nama</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
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
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
