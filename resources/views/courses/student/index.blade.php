@extends('layouts.logged_in')

@section('page-tile', 'My Courses')

@section('content')
    @foreach ($courses as $course)
        <div class="col-md-3 col-xs-12">
            <div class="card rounded hover-overlay hover-zoom hover-shadow ripple">
                <div class="card-body p-0 rounded">
                    <img src="{{ asset('storage/' . $course->image) }}" alt="" class="h-100">
                </div>
                <div class="card-footer">
                    {{-- {{ in_array(12, auth()->user()->courses?->pluck('user_id')->flatten()->toArray()) }} --}}
                    <div class="row">
                        <div class="col">
                            <h3 class="p-0 m-0 text-nowrap">{{ $course->title }}</h3>
                        </div>
                    </div>
                    <div class="page-pretitle">{{ $course->tagline }}</div>
                </div>
                <button class="btn mb-3 mx-3" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    style="background: linear-gradient(90deg, rgb(99, 102, 241), rgb(236, 72, 153)); color: #fff">
                    Options
                </button>
                <ul class="dropdown-menu">
                    @if (auth()->check() && !in_array($course->id, auth()->user()->courses?->pluck('course_id')->flatten()->toArray()))
                        {{-- @if (!in_array($course->id, auth()->user()->courses?->pluck('course_id')->flatten()->toArray())) --}}
                        <li>
                            <button class="dropdown-item" onclick="enroll({{ json_encode($course->id) }})">
                                Enroll
                            </button>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/view-course/{{ $course->id }}">
                                View Details
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="/view-course/{{ $course->id }}" class="dropdown-item">
                                Go to Course
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    @endforeach
    @include('partials.messages')
    <script>
        function enroll(course_id) {
            $.post({!! json_encode(url('/course-enroll')) !!}, {
                _method: "POST",
                data: {
                    course_id: course_id
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
@endsection
