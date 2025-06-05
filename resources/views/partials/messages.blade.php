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
@elseif (session('info'))
    <script>
        Swal.fire({
            title: "Error",
            text: {!! json_encode(session('info')) !!},
            icon: "info"
        });
    </script>
@endif
{{-- <script>
    @if ($message = Session::get('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ $message }}",
            icon: "success",
            didOpen: () => {
                Swal.hideLoading();
            }
        });
    @endif

    @if ($message = Session::get('error'))
        Swal.fire({
            title: "Error!",
            text: "{{ $message }}",
            icon: "error",
            didOpen: () => {
                Swal.hideLoading();
            }
        });
    @endif
</script> --}}
