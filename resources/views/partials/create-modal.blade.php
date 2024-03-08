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
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Action Cancelled",
                        icon: "error",
                        timer: 1000,
                        showConfirmButton: false,
                    });
                }
  
            });
        }
    </script>
@endsection
