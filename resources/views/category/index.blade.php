<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Categories List</title>
    <style>
        .card {
            width: 120%;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 576px) {
            .table-responsive {
                display: block;
                width: 120%;
                overflow-x: auto;
            }
        }

    </style>
</head>
<body>
    @include('welcome')
    @include('category.create')

    <div class="container">
        @if(session('error'))
        <div class="alert alert-danger mb-2">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Categories List</div>
            <div class="card-body">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">Create Categories</button>
                    </div>
                    <div class="col-md-auto">
                        <form action="{{ route('category.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary " type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if($categories->isEmpty())
                <div class="alert alert-danger" role="alert">
                    No Category Records Found
                </div>
                @else
                <table class="table table-striped table-hover table-bordered ">
                    <thead class>
                        <tr class="text-success">
                            <th>SN</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Subcategory Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                @foreach($category->subcategories as $subcategory)
                                <li>{{ $subcategory->name }}</li>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">
                                    <i class="bi bi-pencil-square"></i>                                </a>
                                <form id="deleteForm{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $category->id }}"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($categories->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        @for ($i = 1; $i <= $categories->lastPage(); $i++)
                            <li class="page-item {{ ($categories->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a></li>
                            @endfor

                            @if ($categories->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">&raquo;</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function resetModal() {
            document.getElementById("categoryForm").reset();
            document.querySelectorAll('.error').forEach(error => error.textContent = '');
            document.querySelectorAll('input[name="subnames[]"]').forEach(input => input.parentNode.parentNode.remove());
            // document.querySelectorAll('.btn-danger').forEach(button => button.parentNode.parentNode.remove());
        }

        $('#categoryModal').on('shown.bs.modal', function(e) {
            resetModal();
        });

        $('#categoryModal').on('hidden.bs.modal', function(e) {
            resetModal();
        });


        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue !== '') {
                    $.ajax({
                        url: "{{ route('category.index') }}"
                        , type: "GET"
                        , data: {
                            search: searchValue
                        }
                        , success: function(response) {
                            $('.table tbody').html(response.table);
                            $('.pagination').html(response.pagination);
                        }
                        , error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    location.href = "{{ route('category.index') }}";
                }
            });
        });

    </script>
</body>
</html>
