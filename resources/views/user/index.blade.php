<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
</head>
<style>
    .card {
        width: 120%;
        margin-left: auto;
        margin-right: auto;
    }

</style>
<body>
    @include('welcome')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success mb-2">{{ session('success') }}</div>
        @endif

        @if(session('deleted'))
        <div class="alert alert-danger mb-2">{{ session('deleted') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Registered Users</div>
            <div class="card-body">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-md-auto">
                        <a href="{{ route('user.create') }}" class="text-white btn btn-primary">User Registration</a>
                    </div>
                    <div class="col-md-auto">
                        <form action="{{ route('user.index') }}" method="GET" class="form-inline">
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
                            <th>SN</th>
                            <th>Profile</th>
                            <th>Role</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" style="max-width: 50px; max-height: 50px;">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
                                <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $user->id }}"><i class="bi bi-trash"></i></button>
                                </form>
                                {{-- <button class="btn btn-warning viewBtn" data-toggle="modal" data-target="#userModal{{ $user->id }}" data-id="{{ $user->id }}">View</button> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($users->total() > 0)
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-auto">
                        <p>Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }} results.</p>
                    </div>
                    <div class="col-md-auto">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                @if ($users->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <li class="page-item {{ ($users->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a></li>
                                    @endfor

                                    @if ($users->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a></li>
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

    @foreach($users as $user)
    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p><strong>Role:</strong> {{ $user->role->name }}</p>
                    <p><strong>Name:</strong> {{ $user->firstname }}</p>
                    <p><strong>Last Name:</strong> {{ $user->lastname }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Username:</strong> {{ $user->username }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue !== '') {
                    $.ajax({
                        url: "{{ route('user.index') }}"
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
                    location.href = "{{ route('user.index') }}";
                }
            });
        });

    </script>
</body>
</html>
