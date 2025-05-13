<div class="mt-3">
    <label for="" class="form-label">Description</label>
    <textarea class="form-control" rows="15" {{ auth()->user()->role_id == 3 ? 'disabled' : '' }}>{{ old('description') ? old('description') : (isset($course) ? $course->targetAudience?->description : '') }}</textarea>
</div>
