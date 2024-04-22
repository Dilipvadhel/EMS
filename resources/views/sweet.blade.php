<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deleteBtn').forEach(function (button) {
            button.addEventListener('click', function () {
                var categoryId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This Item is Delete",
                    icon: 'warning',
                    showCancelButton:true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm' + categoryId).submit();
                    }
                });
            });
        });
    });
</script>

</body>
</html>