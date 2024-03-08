<script>
    window.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          title: "Something went wrong!",
          text: "{{$message}}",
          icon: "error",
        });
    });
  </script>