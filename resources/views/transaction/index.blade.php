@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('transaction.create') }}" class="btn btn-primary">Move to Point of Sales<i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
