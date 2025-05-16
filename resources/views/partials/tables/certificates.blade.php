<div class="table-responsive">
    <table class="table-stripped table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Date Granted</th>
                <th>Print</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->course?->title }}</td>
                    <td>{{ $certificate->date_received }}</td>
                    <td>
                        <a href="/certificates-print/{{ $certificate->id }}" class="btn btn-primary">
                            Print Certificate
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
