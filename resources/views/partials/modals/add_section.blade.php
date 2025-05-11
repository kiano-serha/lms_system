<form action="" onsubmit="addSection(event)" id="create_section" method="POST">
    <div class="modal" id="courseSectionModal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Course Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Section Name" required
                            id="section_title" />
                    </div>
                    <label class="form-label">Viewable</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-md-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="section_viewable" value="1"
                                    class="form-selectgroup-input" checked />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        <span class="d-block text-secondary">
                                            Students wil be able to enroll and
                                            complete
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="section_viewable" value="0"
                                    class="form-selectgroup-input" />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">No</span>
                                        <span class="d-block text-secondary">Only you and other admins can see and
                                            edit</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" id="section_description"></textarea>
                    </div>
                    <input type="text" value="{{ $course->id }}" id="section_course_id" hidden>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal" id="close-modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-1">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create Section
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- <script>
    function myFunction(e) {
        e.preventDefaults;
    }
</script> --}}

<script>
    function addSection(event) {
        event.preventDefault();
        $.post({!! json_encode(url('/course-section/store')) !!}, {
            _method: "POST",
            data: {
                title: document.getElementById('section_title').value,
                viewable: document.querySelector("input[name='section_viewable']:checked").value,
                description: document.getElementById('section_description').value,
                course_id: document.getElementById('section_course_id').value
            },
            _token: "{{ csrf_token() }}"
        }).then((end_result) => {
            if (end_result[0] == 'success') {
                swal.fire(
                    "Done!",
                    end_result[1],
                    "success").then(
                    esc => {
                        if (esc) {
                            location
                                .reload();
                        }

                    });
            } else {
                swal.fire(
                    "Oops! Something went wrong.",
                    end_result,
                    "error");
            }
        })
    }
</script>
