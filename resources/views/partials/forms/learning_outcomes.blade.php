<div class="mt-3">
    <label for="" class="form-label">Description</label>
    <textarea class="form-control" rows="15" {{ auth()->user()->role_id == 3 ? 'disabled' : '' }}></textarea>
</div>
