<!DOCTYPE html>
<html lang="en">
<head>
    {{-- resources/views/user/index.blade.php --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @include('welcome')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success mb-2">{{ session('success') }}</div>
        @endif

        @if(session('deleted'))
        <div class="alert alert-danger mb-2">{{ session('deleted') }}</div>
        @endif

        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-auto">
                <a href="{{ route('user.create') }}" class="text-white btn btn-primary mt-5">User Registration</a>
            </div>
            <div class="col-md-auto">
                <form action="{{ route('user.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control mt-5" placeholder="Search..." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary mt-5" type="submit">Search</button>
                        </div>
                        <a href="{{ route('user.index') }}" class="btn btn-danger ml-2 mt-5"><i class="fa fa-refresh" style="font-size:12px"></i></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Registered List</div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr class="text-success">
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
                                <img src="{{ url('storage/' . $user->profile_picture) }}" alt="Profile Picture" style="max-width: 50px; max-height: 50px;">
                                @else
                                No Image
                                @endif

                            </td>
                            <td>{{ ($user->role)->name }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning"><i class='fas fa-edit' style='font-size:15px;'></i>
                                </a>
                                <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $user->id }}">
                                        <i class="fa fa-trash-o" style="font-size:12px"></i>
                                    </button>
                                </form>
                                <button class="btn btn-primary viewBtn" data-toggle="modal" data-target="#userModal{{ $user->id }}" data-id="{{ $user->id }}"><i class="fa fa-eye" style="font-size:12px"></i></button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($users->total() > 0)
                <p>Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }} results.</p>
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
                @else
                <h6 class="text-danger">No results found.</h6>
                @endif
            </div>
        </div>
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
                    <p><strong>Role:</strong> {{($user->role)->name }}</p>
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
</body>
</html>
