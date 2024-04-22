<!DOCTYPE html>
<html lang="en">
{{-- resources/views/role/index.blade.php --}}
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roles</title>
</head>
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
<body>
    @include('welcome')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success mb-2">{{ session('success') }}</div>
        @endif
        @if(session('del'))
        <div class="alert alert-danger mb-2">{{ session('del') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Roles</div>
            <div class="card-body">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-md-auto">
                        <a href="{{ route('role.create') }}" class="text-white btn btn-primary">Create Role</a>
                    </div>
                    <div class="col-md-auto">
                        <form action="{{ route('role.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary " type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
                                <form id="deleteForm{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $role->id }}"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($roles->total() > 0)
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-auto">
                        <p>Showing {{ $roles->firstItem() }} - {{ $roles->lastItem() }} of {{ $roles->total() }} results.</p>
                    </div>
                    <div class="col-md-auto">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                @if ($roles->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $roles->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                @for ($i = 1; $i <= $roles->lastPage(); $i++)
                                    <li class="page-item {{ ($roles->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $roles->url($i) }}">{{ $i }}</a></li>
                                    @endfor

                                    @if ($roles->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $roles->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                    @else
                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                    @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                @else
                <h6 class="text-danger">No results found.</h6>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue !== '') {
                    $.ajax({
                        url: "{{ route('role.index') }}"
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
                    location.href = "{{ route('role.index') }}";
                }
            });
        });

    </script>

</body>
</html>
