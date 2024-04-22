<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subcategories</title>
</head>
<body>
    @include('welcome')
    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Subcategories List </div>
                    <div class="card-body">
                        <p align="right">
                            {{-- <a href="{{ route('subcategory.create') }}" class="text-white btn btn-primary">Subcategories Create</a> --}}
                        </p>
                        <table class="table table-striped table-hover table-bordered ">
                            <thead class="thead-dark">
                                <tr class="text-success">
                                    <th>ID</th>
                                    <th>Category name</th>
                                    <th>Name</th>
                                    {{-- <th>Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{($subcategory->category)->name }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    {{-- <td> <a href="{{ route('subcategory.edit', $subcategory->id) }}" onclick="window.alert('are Sure update')" class="btn btn-dark">Update</a>
                                        <a href="#" class="btn btn-danger">Delete</a></td> --}}

                                    {{-- <td>
                                        <form id="deleteForm{{ $subcategory->id }}" action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $subcategory->id }}">Delete</button>
                                    </form>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                @if ( $subcategories->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{  $subcategories->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                @for ($i = 1; $i <=  $subcategories->lastPage(); $i++)
                                    <li class="page-item {{ ( $subcategories->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{  $subcategories->url($i) }}">{{ $i }}</a></li>
                                    @endfor

                                    @if ( $subcategories->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{  $subcategories->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                    @else
                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                    @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
