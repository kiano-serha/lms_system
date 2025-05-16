@extends('layouts.logged_in')

@section('page-tile')
    All Your Certificates
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                Certificates Table
            </div>
            <div class="card-body">
                @include('partials.tables.certificates')
            </div>
        </div>
        @include('partials.messages')
    </div>
@endsection
