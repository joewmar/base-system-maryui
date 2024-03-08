@push('scripts')
    <script>
        function cancelModal() {
            Swal.fire({
                title: "Action Cancelled",
                icon: "error",
                timer: 1000,
                showConfirmButton: false,
            });
        }
    </script>
@endpush
