<html lang="en">
<head>
    {{-- resources/views/welcome.blade.php --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a {
            color: #007bff;
            text-decoration: none;
        }

        a.active {
            color: #1a36c4;
            font-weight: bold;
            background-color: rgb(76, 74, 74);

        }

        .sidebar-link {
            display: block;
            text-decoration: none;
            color: #fff;
            transition: color 0.5s ease;
            padding:    8px 2px;
            width: 100%;
                     
        }

        .sidebar-link:hover {
            background-color: darkseagreen;
            color: #ccc;
            width: 100%;
            
        }

        body {
            overflow-x: hidden;
        }       
        #page-content-wrapper {
            width: 100%;
            padding: 15px;
            margin-top: 50px;
        }
        @media(min-width:768px) {
            #wrapper {
                padding-left: 250px;
            }
            #wrapper.toggled {
                padding-left: 0;
            }
            /* Sidebar Styles */
            #sidebar-wrapper {
                position: fixed;
                left: 0;
                width: 272px;
                height: 110%;
                margin-left: -1px;
                margin-top: -4.5%;
                overflow-y: auto;
                background: #393e46;
                transition: all 0.5s ease;
            }
            #page-content-wrapper {
                padding: 20px;
                position: relative;
            }          
        }
        .footer {
            background-color: darkslategrey;
            color: white;
            padding: px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <div id="wrapper">
        @include('includes.sidebar')

        <div id="page-content-wrapper">
            <div class="header">
            </div>

                <div class="row">
                  @include('includes.header')
                    <div class="col">
                    </div>
                </div>

            @include('includes.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.deleteBtn').forEach(function(button) {
            button.addEventListener('click', function() {
                var categoryId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This item will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
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



