<div class="card">
    <div class="card-body p-0">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Viewable</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->title }}</td>
                        <td>{{ $section->viewable }}</td>
                        <td>{{ substr($section->description, 0, 20) . '...' }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#courseSectionContentModal"
                                onclick="setSectionId({{ json_encode($section->id) }})">
                                Add Content
                            </button>
                            <button class="btn btn-danger btn-sm">
                                Remove Visibility
                            </button>
                            <button class="btn btn-warning btn-sm">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('partials.modals.add_section_content')

<script>
    function setSectionId(id) {
        document.getElementById('section_id_c').value = id;
    }
</script>
