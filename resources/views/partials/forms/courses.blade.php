{{-- <div class="col-md-8"> --}}
<div class="mt-3">
    <label for="" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $course->title }}">
</div>
<div class="row mt-3">
    <div class="col">
        <label for="" class="form-label">Tagline</label>
        <input type="text" class="form-control" name="tagline"
            value="{{ old('tagline') ? old('tagline') : $course->tagline }}">
    </div>
    <div class="col">
        <label for="" class="form-label">Category</label>
        <select name="category_id" id="" class="form-select">
            <option selected disabled>Please select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-3">
    <label for="" class="form-label">Price</label>
    <input type="number" class="form-control" name="price"
        value="{{ old('price') ? old('price') : $course->price }}">
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
            <option value="1"
                {{ old('issue_certificate')
                    ? (old('issue_certificate') == '1'
                        ? 'selected'
                        : '')
                    : ($course->issue_certificate == '1'
                        ? 'selected'
                        : '') }}>
                Yes</option>
            <option value="0"
                {{ old('issue_certificate')
                    ? (old('issue_certificate') == '0'
                        ? 'selected'
                        : '')
                    : ($course->issue_certificate == '0'
                        ? 'selected'
                        : '') }}>
                No</option>
        </select>
    </div>
    <div class="col">
        <label for="" class="form-label">Make this course active?</label>
        <select name="active" id="" class="form-control">
            <option disabled selected>Please select an option</option>
            <option value="1"
                {{ old('active') ? (old('active') == '1' ? 'selected' : '') : ($course->active == '1' ? 'selected' : '') }}>
                Yes</option>
            <option value="0"
                {{ old('active') ? (old('active') == '0' ? 'selected' : '') : ($course->active == '0' ? 'selected' : '') }}>
                No</option>
        </select>
    </div>
</div>
<div class="mt-3">
    <label for="" class="form-label">Description</label>
    <textarea class="form-control" name="description">{{ old('description') ? old('description') : $course->description }}</textarea>
</div>
{{-- </div> --}}
