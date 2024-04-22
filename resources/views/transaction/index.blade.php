<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
</head>
<body>
    @include('welcome')
    <div class="container">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-auto">
            </div>
            <div class="col-md-auto">
                <form action="{{ route('transaction.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control " placeholder="Search..." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary " type="submit">Search</button>
                        </div>
                            <a href="{{ route('transaction.index') }}" class="btn btn-danger ml-2 "><i class="fa fa-refresh" style="font-size:12px"></i></a>
                    </div>
                </form>
            </div>
        </div>   
             
        <h2 class="text-primary" style="font-family: bold; ">Transactions</h2>
        @if($transactions->isEmpty())
        <div class="alert alert-danger" role="alert">
            No Transaction Records Found
        </div>
        @else
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
    {{-- {{ $transactions->links('pagination::bootstrap-4') }} --}}


</body>
</html>
