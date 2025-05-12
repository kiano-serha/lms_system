<div class="card">
    <div class="card-body p-0">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Prerequisite sections</th>
                    <th>Viewable</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->id }}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>
                            @foreach ($quiz->quizPrerequisites as $prerequisite)
                                {{ $prerequisite->section?->title . ',' }}
                            @endforeach
                        </td>
                        <td>{{ $quiz->viewable }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Make Visible</button>
                            <button class="btn btn-sm btn-info">Add Questions</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
