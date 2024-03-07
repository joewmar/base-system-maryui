@section('scripts')
    <script>
        function createModal(method, message, key) {
            Swal.fire({
                title: "Are you sure?",
                text: message ,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#22C55E",
                cancelButtonColor: "#EF4444",
                confirmButtonText: "Yes, "+key+" it!",
                cancelButtonText: "No, cancel!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(method);
                }
            });
        }
    </script>
@endsection
