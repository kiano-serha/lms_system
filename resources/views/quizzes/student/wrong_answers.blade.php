@extends('layouts.logged_in')

@section('page-pretitle', 'Corrections')

@section('page-tile')
    {{ $quiz_title }}
@endsection

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">Please see below for corrections</div>
            <div class="card-body">
                <ol class="list-group list-group-numbered">
                    @foreach ($questions as $question)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="form-label">{{ $question->question }}</div>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" checked>
                                        <span class="form-check-label">Correct Answer:
                                            {{ $question->correctAnswer?->answer }}</span>
                                    </label>
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ol>
                <a class="btn btn-info mt-4" href="/view-course/{{ $course_id }}">
                    Go Back to course
                </a>
            </div>

        </div>
    </div>
    {{-- {{ session('error') }} --}}
    @include('partials.messages')
@endsection
