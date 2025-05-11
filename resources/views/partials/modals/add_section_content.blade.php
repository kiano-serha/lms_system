<form action="" onsubmit="addContent(event)" id="create_section" method="POST">
    <div class="modal" id="courseSectionContentModal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Section Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="content_title" placeholder="Content Title"
                            required id="content_title" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Text Content</label>
                        <textarea class="form-control" rows="5" id="content_description"></textarea>
                    </div>
                    <input type="text" value="{{ $course->id }}" id="course_id_for_content" hidden>
                    <input type="text" class="form-control" id="section_id_c" hidden>
                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col"><label for="" class="form-label">Links</label></div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-sm" type="button" onclick="addLink()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Add Link
                                </button>
                            </div>
                        </div>
                        <div id="links">
                            <div class="row mb-1">
                                <div class="col-md-9">
                                    <input type="text" class="form-control link-title">
                                </div>
                                <div class="col-md-3">
                                    <select name="" id="" class="form-select link-type">
                                        <option value="audio">Audio</option>
                                        <option value="vid">Video</option>
                                        <option value="info">Article</option>
                                    </select>
                                </div>
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
                        Add Content
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
    function addLink() {
        links = document.getElementById('links');

        //div row
        row = document.createElement('div');
        row.classList.add('row', 'mb-1');

        //div col-md-9
        col_md_9 = document.createElement('div');
        col_md_9.classList.add('col-md-9');

        //input
        var input = document.createElement('input');
        input.classList.add('form-control', 'link-title');

        col_md_9.appendChild(input);
        row.appendChild(col_md_9);

        //div col-md-3
        col_md_3 = document.createElement('div');
        col_md_3.classList.add('col-md-3');


        //select
        select = document.createElement('select');
        select.classList.add('form-select', 'link-type');


        //Option
        option1 = document.createElement('option');
        option1.innerHTML = "Audio";
        option1.value = "audio";
        select.appendChild(option1);

        option2 = document.createElement('option');
        option2.innerHTML = "Video";
        option2.value = "video";
        select.appendChild(option2);

        option3 = document.createElement('option');
        option3.innerHTML = "Article";
        option3.value = "article";
        select.appendChild(option3);

        col_md_3.appendChild(select);

        row.appendChild(col_md_3);

        links.appendChild(row);
    }
</script>

<script>
    function addContent(event) {
        event.preventDefault();
        //get all links
        var link_titles = [];
        document.querySelectorAll("input.link-title").forEach((element) => {
            link_titles.push(element.value);
        });

        //get all link types
        var link_types = [];
        document.querySelectorAll("select.link-type").forEach((element) => {
            link_types.push(element.value);
        });

        $.post({!! json_encode(url('/section-content/store')) !!}, {
            _method: "POST",
            data: {
                title: document.getElementById('content_title').value,
                description: document.getElementById('content_description').value,
                course_id: document.getElementById('course_id_for_content').value,
                section_id: document.getElementById('section_id_c').value,
                link_titles: link_titles,
                link_types: link_types
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
