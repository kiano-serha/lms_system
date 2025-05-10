@extends('layouts.logged_in')

@section('page-tile', 'Create Course')

@section('content')
    {{-- <div class="col"> --}}
    {{ $errors }}
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="col">
        @csrf
        @method('POST')
        <div class="card">
            <div class="card-header">
                Course Details
            </div>
            <div class="card-body">

                <div class="">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="" class="form-label">Tagline</label>
                        <input type="text" class="form-control" name="tagline" value="{{ old('tagline') }}">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Category</label>
                        <select name="category_id" id="" class="form-select">
                            <option selected disabled>Please select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="" class="form-label">Does this course have a certificate?</label>
                        <select name="issue_certificate" class="form-control">
                            <option disabled selected>Please select an option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Make this course active?</label>
                        <select name="active" id="" class="form-control">
                            <option disabled selected>Please select an option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Description</label>
                    <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    Create Course
                </button>
            </div>
        </div>
    </form>
    {{-- </div> --}}
    @include('partials.messages')
@endsection
