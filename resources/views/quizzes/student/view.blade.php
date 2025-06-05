@extends('layouts.logged_in')

@section('page-tile')
    {{ $quiz->title }}
@endsection

@section('content')
    <div class="col h-75">
        <div class="card h-75">
            <div class="card-header">
                <h4 class="m-0">Please answer all questions</h4>
            </div>
            <div class="card-body overflow-auto h-100">
                <form action="{{ route('quiz.attempt.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="text" hidden name="quiz_id" value="{{ $quiz->id }}">
                    <ol class="list-group list-group-numbered">
                        @foreach ($quiz->quizQuestions as $question)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="form-label">{{ $question->question }}</div>
                                    @foreach ($question->questionAnswers as $answer)
                                        <div>
                                            <label class="form-check">
                                                <input class="form-check-input" type="radio" value="{{ $answer->id }}"
                                                    name="answer[{{ $question->id }}]" required>
                                                <span class="form-check-label">{{ $answer->answer }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ol>
                    <button class="btn btn-primary mt-3" type="submit">
                        Submit Answers
                    </button>
                    <button class="btn btn-danger">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('partials.messages')
@endsection
