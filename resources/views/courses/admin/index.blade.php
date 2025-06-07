@extends('layouts.logged_in')

@section('page-tile', 'All Courses')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tagline</th>
                            <th>Price</th>
                            <th>Active</th>
                            <th>Issue Certificate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td >{{ $course->title }}</td>
                                <td>{{ $course->category?->title }}</td>
                                <td>{{ $course->tagline }}</td>
                                <td>{{ $course->price }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-{{ $course->active == 1 ? 'green' : 'red' }} text-{{ $course->active == 1 ? 'green' : 'red' }}-fg">
                                        {{ $course->active == 1 ? 'YES' : 'NO' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-{{ $course->issue_certificate == 1 ? 'green' : 'red' }} text-{{ $course->issue_certificate == 1 ? 'green' : 'red' }}-fg">
                                        {{ $course->issue_certificate == 1 ? 'YES' : 'NO' }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="/courses-edit/{{ $course->id }}" class="btn btn-warning btn-sm">Edit</a>
                                    {{-- <a href="" class="btn btn-primary"></a> --}}
                                    <button class="btn {{ $course->active == 1 ? "btn-danger" : "btn-success" }} btn-sm" onclick="changeActiveStatus({{ $course->id }})">
                                        {{ $course->active == 1 ? "Inactivate" : "Activate" }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function changeActiveStatus(id){
            $.post({!! json_encode(url('/course/active-stat')) !!}, {
                _method: "POST",
                data: {
                    id: id
                },
                _token: "{{ csrf_token() }}"
            }).then((end_result) => {
                // console.log(end_result);
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
@endsection
