@extends('layouts.logged_in')

@section('page-tile')
    Course - {{ $course->title }}
@endsection

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 justify-content-between d-flex">
                        <ul class="steps steps-counter steps-vertical ">
                            <li class="step-item active" onclick="showSection(1, this)">Course Details</li>
                            <li class="step-item" onclick="showSection(2, this)">Learning Outcomes</li>
                            <li class="step-item" onclick="showSection(3, this)">Target Audience</li>
                            <li class="step-item" onclick="showSection(4, this)">Curriculum</li>
                            <li class="step-item" onclick="showSection(5, this)">Quizzes</li>
                            {{-- <li class="step-item active">Course Details</li>
                            <li class="step-item">Learning Outcomes</li>
                            <li class="step-item">Target Audience</li>
                            <li class="step-item">Curriculum</li>
                            <li class="step-item">Quiz</li>
                            <li class="step-item">Students</li> --}}
                        </ul>
                    </div>
                    <div class="vr p-0 mx-5"></div>
                    <div class="col">
                        {{-- Course details --}}
                        <div id="section_1" class="course_sections">
                            <h2 class="text-muted fw-bold">Course Details</h2>
                            <hr class="p-0 m-0">
                            <form action="">
                                @include('partials.forms.courses')
                                <button class="btn btn-info mt-4 mb-3">
                                    Update Information
                                </button>
                            </form>
                        </div>

                        {{-- Learning Outcomes --}}
                        <div id="section_2" style="display:none" class="course_sections">
                            <h2 class="text-muted fw-bold">Learning Outcome</h2>
                            <hr class="p-0 m-0">
                            <form action="">
                                @include('partials.forms.learning_outcomes')
                                <button class="btn btn-primary mt-3">
                                    Submit Learning Outcome
                                </button>
                            </form>
                        </div>

                        {{-- Target Audience --}}
                        <div id="section_3" style="display:none" class="course_sections">
                            <h2 class="text-muted fw-bold">Target Audience</h2>
                            <hr class="p-0 m-0">
                            <form action="">
                                @include('partials.forms.target_audience')
                                <button class="btn btn-primary mt-3">
                                    Submit Target Audience
                                </button>
                            </form>
                        </div>

                        {{-- Curriculum --}}
                        <div id="section_4" style="display:none" class="course_sections">
                            <div class="row">
                                <div class="col">
                                    <h2 class="text-muted fw-bold">
                                        Curriculum
                                    </h2>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#courseSectionModal">
                                        Add New Section
                                    </button>
                                </div>
                            </div>
                            <hr class="m-0">
                            @include('partials.tables.course_sections')
                            @include('partials.modals.add_section')
                        </div>

                        {{-- Quizzes --}}
                        <div id="section_5" style="display:none" class="course_sections">
                            <div class="row">
                                <div class="col">
                                    <h2 class="text-muted fw-bold">
                                        Course Quizzes
                                    </h2>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal"
                                        onclick="addSections({{ json_encode($course->courseSections) }})">
                                        Add New Quiz
                                    </button>
                                </div>
                            </div>
                            <hr class="m-0">
                            @include('partials.tables.quizes')
                            @include('partials.modals.add_quiz')
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
        function showSection(section_id, element) {
            // console.log(element);
            // console.log()
            divs = document.querySelectorAll("div.course_sections");
            divs.forEach((section) => {
                section.style.display = "none";
            });

            document.querySelectorAll('li.step-item').forEach((list_item) => {
                list_item.classList.remove('active');
            })

            document.getElementById('section_' + section_id).style.display = '';


            if (!element.classList.contains('active')) {
                element.classList.add('active');
            }
        }
    </script>
@endsection
