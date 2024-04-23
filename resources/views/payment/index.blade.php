<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payments List</title>
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
        
        <div class="card">
            <div class="card-header">Payments List</div>
            <div class="card-body">
                @if($payments->isEmpty())
                <div class="alert alert-danger" role="alert">
                    No payments Record Found
                </div>
                @else
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-md-auto">
                        <a href="{{ route('payment.create') }}" class="text-white btn btn-primary">Payment</a>
                    </div>
                    <div class="col-md-auto">
                        <form action="{{ route('payment.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary " type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-striped table-hover table-bordered">
                    <thead class>
                        <tr class="text-success">
                            <th>Vendor</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->vendor->vendor_name }}</td>
                            <td>{{ $payment->date }}</td>
                            {{-- <td>{{ date('d-m-20y', strtotime($payment->date))}}</td> --}}
                            <td>{{ $payment->amount }}</td>
                            <td>
                                <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn btn-info"><i class="bi bi-pencil-square"></i></a>

                                <form id="deleteForm{{ $payment->id }}" action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $payment->id }}"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($payments->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $payments->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif
                        @for ($i = 1; $i <= $payments->lastPage(); $i++)
                            <li class="page-item {{ ($payments->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $payments->url($i) }}">{{ $i }}</a></li>
                            @endfor

                            @if ($payments->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $payments->nextPageUrl() }}" rel="next">&raquo;</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                    </ul>
                </nav>
                @endif
            </div>
        </div>
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
                        url: "{{ route('payment.index') }}"
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
                    location.href = "{{ route('payment.index') }}";
                }
            });
        });

    </script>
</body>
</html>
