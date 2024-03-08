@push('styles')
    <script>
        function deleteModal(delID, name) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to remove this: " + name,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('remove', {id: delID});
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
@endpush
