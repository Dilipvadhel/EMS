<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <style>
        .card {
            width: 120%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
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
    @if($transactions->isEmpty())
    {{-- <div class="alert alert-danger w-50 ml-5" role="alert">
        No Transaction Records Found
    </div> --}}
    @else
    <div class="container">
        <div class="card">
            <div class="card-header">Transactions</div>
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-auto"></div>
                    <div class="col-md-auto">
                        <form action="{{ route('transaction.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search..." name="search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary " type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Vendor</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
                        <td>{{ $transaction->vendor ? $transaction->vendor->vendor_name : '-' }}</td>
                        <td>{{ $transaction->credit }}</td>
                        <td>{{ $transaction->debit }}</td>
                        <td>{{ $transaction->balance }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if ($transactions->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $transactions->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @for ($i = 1; $i <= $transactions->lastPage(); $i++)
                        <li class="page-item {{ ($transactions->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a></li>
                        @endfor

                        @if ($transactions->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $transactions->nextPageUrl() }}" rel="next">&raquo;</a></li>
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
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue !== '') {
                    $.ajax({
                        url: "{{ route('transaction.index') }}"
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
                    location.href = "{{ route('transaction.index') }}";
                }
            });
        });

    </script>

</body>
</html>
