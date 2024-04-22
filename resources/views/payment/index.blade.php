<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payments List</title>
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
                <a href="{{ route('payment.create') }}" class="text-white btn btn-primary mt-5">Payment</a>
            </div>
            <div class="col-md-auto">
                <form action="{{ route('payment.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control mt-5" placeholder="Search..." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary mt-5" type="submit">Search</button>
                        </div>
                        <a href="{{ route('payment.index') }}" class="btn btn-danger ml-2 mt-5"><i class="fa fa-refresh" style="font-size:12px"></i></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Payments List</div>
            <div class="card-body">
                @if($payments->isEmpty())
                <div class="alert alert-danger" role="alert">
                    No payments Record Found
                </div>
                @else
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
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
                                <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn btn-dark">Edit</a>

                                <form id="deleteForm{{ $payment->id }}" action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $payment->id }}">Delete</button>
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
</body>
</html>
