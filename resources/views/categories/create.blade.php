@extends('layouts.logged_in')
@section('page-tile', 'Category')

@section('content')
    <form action="{{ route('categories.store') }}" enctype="multipart/form-data" method="POST">
        <div class="col">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Add Category
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">Parent</label>
                            <select name="category_id" id="" class="form-select">
                                <option value="">Please select an option</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id="" class="form-control"></textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
