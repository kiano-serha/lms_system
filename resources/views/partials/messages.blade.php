@if (session('success'))
    <script>
        Swal.fire({
            title: "Success",
            text: {!! json_encode(session('success')) !!},
            icon: "success"
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            title: "Error",
            text: {!! json_encode(session('error')) !!},
            icon: "error"
        });
    </script>
@endif
