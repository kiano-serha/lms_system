<form action="" onsubmit="addQuiz(event)" id="" method="POST">
    <div class="modal" id="quizModal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="quiz_title" placeholder="Content Title"
                            required id="quiz_title" />
                    </div>
                    <label class="form-label">Viewable</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-md-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="quiz_viewable" value="1" class="form-selectgroup-input"
                                    checked />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Yes</span>
                                        <span class="d-block text-secondary">
                                            Students wil be able to see
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="quiz_viewable" value="0"
                                    class="form-selectgroup-input" />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">No</span>
                                        <span class="d-block text-secondary">Only you and other admins can see</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <input type="text" value="{{ $course->id }}" id="course_id_for_quiz" hidden>
                    <div class="mb-3">
                        <label for="" class="form-label">Prerequisites</label>
                        <div class="mb-3">
                            <div id="checkbox_container">
                                {{-- <label class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-label">Checkbox input</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="form-check-label">Disabled checkbox input</span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <span class="form-check-label">Checked checkbox input</span>
                                </label> --}}
                            </div>
                        </div>
                    </div>
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
                        Add Quiz
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
    function addSections(sections) {
        //checkboxes
        checkboxes = document.getElementById('checkbox_container');
        checkboxes.innerHTML = "";
        sections.forEach((element) => {
            console.log(element['id'])
            label = document.createElement('div');
            label.classList.add('form-check');

            //input checkbox
            input = document.createElement('input');
            input.classList.add('form-check-input');
            input.setAttribute('type', 'checkbox');
            input.setAttribute('name', 'prerequisites');
            input.value = element['id'];

            //span
            span = document.createElement('span');
            span.classList.add('form-check-label');
            span.innerHTML = element['title'];

            label.appendChild(input);
            label.appendChild(span);
            checkboxes.appendChild(label);
        })
    }
</script>

<script>
    function addQuiz(event) {
        event.preventDefault();
        var prereq_sections = [];
        document.querySelectorAll("input[name=prerequisites]:checked").forEach((element) => {
            prereq_sections.push(element.value);
        });

        console.log(prereq_sections);

        //get all link type

        $.post({!! json_encode(url('/quiz/store')) !!}, {
            _method: "POST",
            data: {
                title: document.getElementById('quiz_title').value,
                viewable: document.querySelector("input[name='quiz_viewable']:checked").value,
                course_id: document.getElementById('course_id_for_quiz').value,
                prereq_sections: prereq_sections
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
