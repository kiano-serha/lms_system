<div class="mt-3">
    <label for="" class="form-label">Description</label>
    <textarea class="form-control" rows="15"
        {{ auth()->check() ? (auth()->user()->role_id == 3 ? 'disabled' : '') : 'disabled' }}>{{ old('description') ? old('description') : (isset($course) ? $course->learningOutcome?->description : '') }}</textarea>
</div>
