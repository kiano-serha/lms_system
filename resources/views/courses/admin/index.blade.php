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
                                        class="badge bg-{{ $course->issue_certification == 1 ? 'green' : 'red' }} text-{{ $course->issue_certification == 1 ? 'green' : 'red' }}-fg">
                                        {{ $course->issue_certification == 1 ? 'YES' : 'NO' }}
                                    </span>
                                </td>
                                <td >
                                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                                    {{-- <a href="" class="btn btn-primary"></a> --}}
                                    <a href="" class="btn btn-danger btn-sm">Inactivate</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
