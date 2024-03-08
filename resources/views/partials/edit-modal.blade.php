@push('styles')
    <script>
        function editModal(editID) {
            Swal.fire({
                title: "Are you sure?",
                text: 'Do you want to change this' ,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#22C55E",
                cancelButtonColor: "#EF4444",
                confirmButtonText: "Yes, change it!",
                cancelButtonText: "No, cancel!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('save',  {id: editID});
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
