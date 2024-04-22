<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subcategories</title>
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
    <div class="container">
        <div class="card">
            <div class="card-header">Subcategories List</div>
            <div class="card-body">
                <p align="right">
                    {{-- <a href="{{ route('subcategory.create') }}" class="text-white btn btn-primary">Subcategories Create</a> --}}
                </p>
                <table class="table table-striped table-hover table-bordered ">
                    <thead class>
                        <tr class="text-success">
                            <th>ID</th>
                            <th>Category name</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{($subcategory->category)->name }}</td>
                            <td>{{ $subcategory->name }}</td>
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

                        @for ($i = 1; $i <= $subcategories->lastPage(); $i++)
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
</body>
</html>
