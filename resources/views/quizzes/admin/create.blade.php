@extends('layouts.logged_in')

@section('page-tile')
    Add Questions
@endsection

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row w-100">
                    <div class="col">
                        <h3 class="m-0">
                            Questions for Quiz
                        </h3>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" onclick="addQuestion()">Add Question</button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('store.questions') }}" method="POST">
                    @csrf
                    @method('POST')
                    <ol class="list-group list-group-numbered" id ="questions">
                        <li class="list-group-item d-flex">
                            <div class="ms-2 me-auto w-100">
                                <label for="" class="form-label">Enter Question</label>
                                <input type="text" class="form-control mb-2" name="questions[]">
                                <label for="" class="form-label">Answer 1</label>
                                <input type="text" class="form-control mb-2" required name="answers_1[]">
                                <label for="" class="form-label">Answer 2</label>
                                <input type="text" class="form-control mb-2" required name="answers_2[]">
                                <label for="" class="form-label">Answer 3</label>
                                <input type="text" class="form-control mb-2" required name="answers_3[]">
                                <label for="" class="form-label">Answer 4</label>
                                <input type="text" class="form-control mb-2" required name="answers_4[]">
                                <label for="" class="form-label">Correct Answer</label>
                                <select name="correct_answers[]" id="" required class="form-select">
                                    <option value="1">Answer 1</option>
                                    <option value="2">Answer 2</option>
                                    <option value="3">Answer 3</option>
                                    <option value="4">Answer 4</option>
                                </select>
                                {{-- <div class="row">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button class="btn btn-danger btn-danger" onclick="removeQuestion(this)">
                                            Remove Question
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                        </li>
                    </ol>
                    <input type="text" value="{{ $quiz_id }}" name="quiz_id" hidden>
                    <button class="btn btn-primary mt-4" type="submit">Submit Questions</button>
                    <button class="btn btn-danger mx-1 mt-4" type="button">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addQuestion() {
            var list_item = document.createElement('li');
            list_item.classList.add('list-group-item', 'd-flex');

            question_container = document.createElement('div');
            question_container.classList.add('ms-2', 'me-auto', 'w-100');

            question_label = newElement('label', ['form-label'], 'Please enter question', {});
            question_input = newElement('input', ['form-control', 'mb-2'], '', {
                required: true,
                name: 'questions[]'
            });

            answer_label_1 = newElement('label', ['form-label'], 'Answer 1', {});
            answer_label_2 = newElement('label', ['form-label'], 'Answer 2', {});
            answer_label_3 = newElement('label', ['form-label'], 'Answer 3', {});
            answer_label_4 = newElement('label', ['form-label'], 'Answer 4', {});

            answer_input_1 = newElement('input', ['form-control', 'mb-2'], '', {
                required: true,
                name: 'answers_1[]'
            });
            answer_input_2 = newElement('input', ['form-control', 'mb-2'], '', {
                required: true,
                name: 'answers_2[]'
            });
            answer_input_3 = newElement('input', ['form-control', 'mb-2'], '', {
                required: true,
                name: 'answers_3[]'
            });
            answer_input_4 = newElement('input', ['form-control', 'mb-2'], '', {
                required: true,
                name: 'answers_4[]'
            });

            correct_answer_label = newElement('label', ['form-label'], 'Correct Answer', {});
            correct_answer = newElement('select', ['form-select', 'mb-2'], '', {
                name: 'correct_answers[]',
                required: true
            });

            option_1 = newElement('option', [], 'Answer 1', {
                value: '1'
            });
            option_2 = newElement('option', [], 'Answer 2', {
                value: '2'
            });
            option_3 = newElement('option', [], 'Answer 3', {
                value: '3'
            });
            option_4 = newElement('option', [], 'Answer 4', {
                value: '4'
            });

            addChildELement(correct_answer, [option_1, option_2, option_3, option_4]);

            row = newElement('div', ['row'], '', {});
            col = newElement('div', ['col'], '', {});
            col_auto = newElement('div', ['col-auto'], '', {});

            button = newElement('button', ['btn', 'btn-danger', 'btn-sm'], 'Remove Question', {
                onclick: 'removeQuestion(this)'
            })

            addChildELement(col_auto, [button])
            addChildELement(row, [col, col_auto]);

            addChildELement(question_container, [question_label, question_input, answer_label_1, answer_input_1,
                answer_label_2, answer_input_2, answer_label_3, answer_input_3, answer_label_4, answer_input_4,
                correct_answer_label,
                correct_answer, row
            ]);

            addChildELement(list_item, [question_container]);

            addChildBasedOnId('questions', [list_item]);

        }

        function newElement(element_type, class_list, inner_html, attributes) {
            var newElement = document.createElement(element_type);

            if (inner_html != '') {
                newElement.innerHTML = inner_html;
            }

            Object.keys(attributes).forEach((element) => {
                newElement.setAttribute(element, attributes[element]);
            })

            class_list.forEach((element) => {
                newElement.classList.add(element);
            });

            return newElement;
        }

        function addChildBasedOnId(element_id, children) {
            children.forEach((element) => {
                document.getElementById(element_id).appendChild(element);
            })
        }

        function addChildELement(parentElement, children) {
            children.forEach((element) => {
                parentElement.appendChild(element);
            })
        }

        function removeQuestion(element) {
            document.getElementById('questions').removeChild(element.parentNode.parentNode.parentNode.parentNode);
        }
    </script>
    @include('partials.messages')
@endsection
