<div class="accordion mt-3" id="accordion-example">
    @foreach ($course->quizzes as $quiz)
        <div class="accordion-item mb-2 border rounded">
            <h2 class="accordion-header" id="heading-1">
                <button class="accordion-button " type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $quiz->id }}" aria-expanded="true">
                    {{ $quiz->title }}
                </button>
            </h2>
            <div id="collapse-{{ $quiz->id }}" class="accordion-collapse collapse"
                data-bs-parent="#accordion-example">
                <div class="accordion-body pt-0">
                    <div class="fw-bold">
                        Sections Needed to Attempt
                    </div>
                    <ul>
                        @foreach ($quiz->quizPrerequisites as $prereq)
                            <li class="list-item">
                                {{ $prereq->section?->title }}
                            </li>
                        @endforeach
                    </ul>
                    <a class="btn btn-success" href="/quiz-attempt/{{ $quiz->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-speedtest">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5.636 19.364a9 9 0 1 1 12.728 0" />
                            <path d="M16 9l-4 4" />
                        </svg>
                        Start Quiz
                    </a>
                </div>
            </div>

        </div>
    @endforeach
</div>
