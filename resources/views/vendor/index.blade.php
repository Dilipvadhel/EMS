<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="printModalLabel">Vendor Transactions</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="vendorDetails">
                        <label for="vendor_id">Vendor Name:</label><br>
                        <select class="form-control mb-3 @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id">
                            <option value="">Select Vendor</option>
                            @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                            @endforeach
                        </select>
                        <div id="vendor_id-error" class="invalid-feedback">This is required</div>
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date">
                            <div id="start_date-error" class="invalid-feedback">This is required</div>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date">
                            <div id="end_date-error" class="invalid-feedback">This is required</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="printBtn">Print</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Vendor List</div>
            <div class="card-body">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-md-auto">
                        <a href="#" class="text-white btn btn-dark" id="printModalBtn">Print</a>
                        <a href="{{ route('vendor.create') }}" id="ch" class="text-white btn btn-primary"> Vendor Create</a> </div>
                    <div class="col-md-auto">

                        <form action="{{ route('vendor.index') }}" method="GET" class="form-inline">
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
                            <th>Vendor Name</th>
                            <th>Company Name</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Balance</th>
                            <th>Action</th>
                            {{-- <th>PDF</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                        <tr>

                            <td>{{ $vendor->vendor_name }}</td>
                            <td>{{ $vendor->company_name }}</td>
                            <td>{{ $vendor->mobile_no }}</td>
                            <td>{{ $vendor->address }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>
                                <button class="btn btn-success openModal" data-vendor="{{ $vendor->id }}" style="width:75%">{{ $vendor->balance }}</button>
                            </td>
                            <td>
                                <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>

                                <form id="deleteForm{{ $vendor->id }}" action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger deleteBtn" data-id="{{ $vendor->id }}"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>

                            {{-- <td>
                                <a href="{{ route('vendor.pdf', ['vendorId' => $vendor->id]) }}" style="font-size:36px;color:red" class="fa fa-file-pdf-o"></a>
                            </td> --}}

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($vendors->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $vendors->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        @for ($i = 1; $i <= $vendors->lastPage(); $i++)
                            <li class="page-item {{ ($vendors->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $vendors->url($i) }}">{{ $i }}</a></li>
                            @endfor

                            @if ($vendors->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $vendors->nextPageUrl() }}" rel="next">&raquo;</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                   </nav>
               </div>
          </div>

        <div class="modal" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-primary" id="transactionModalLabel">Vendor Transactions</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="transactionTable">
                            <thead>
                                <tr>
                                    <th>Transaction Date</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function generatePdf(vendorId, vendorName) {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;
            if (startDate && endDate) {
                var url = '{{ route("vendor.pdf", [":vendorId", "start_date" => ":startDate", "end_date" => ":endDate"]) }}';
                url = url.replace(':vendorId', vendorId).replace(':startDate', startDate).replace(':endDate', endDate);
                window.location.href = url;
            }

        }

        $(document).ready(function() {
            function resetModalFields() {
                $('#vendor_id').val('');
                $('#start_date').val('');
                $('#end_date').val('');
            }

            $('#printModal').on('hidden.bs.modal', function(e) {
                resetModalFields();
            });

            $('#printModalBtn').click(function() {
                $('#printModal').modal('show');
            });

            $('#printBtn').click(function() {});

        });


        document.getElementById('printBtn').addEventListener('click', function() {
            var vendorId = document.getElementById('vendor_id').value;
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;
            var url = '{{ route("vendor.pdf", ":vendorId") }}';
            url = url.replace(':vendorId', vendorId);
            if (startDate && endDate) {
                url += '?start_date=' + startDate + '&end_date=' + endDate;
                window.location.href = url;
            }
        });

        $('#printModalBtn').click(function() {
            $('#printModal').modal('show');

        });

        $('#printBtn').click(function() {
            var vendorId = $('#vendor_id').val();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var url = '{{ route("vendor.pdf", ":vendorId") }}';
            url = url.replace(':vendorId', vendorId);
            if (startDate && endDate) {
                url += '?start_date=' + startDate + '&end_date=' + endDate;
                window.location.href = url;
            }
        });

        $(document).ready(function() {
            $('.openModal').click(function() {
                var vendorId = $(this).data('vendor');
                $('#transactionModal').modal('show');
                fetchTransactions(vendorId);
            });

            function fetchTransactions(vendorId) {
                axios.get('/vendor/transactions/' + vendorId)
                    .then(function(response) {
                        var transactionsHtml = '';
                        response.data.forEach(function(transaction) {
                            transactionsHtml += '<tr>' +
                                '<td>' + transaction.transaction_date + '</td>' +
                                '<td>' + transaction.credit + '</td>' +
                                '<td>' + transaction.debit + '</td>' +
                                '<td>' + transaction.balance + '</td>' +
                                '</tr>';
                        });
                        $('#transactionTable tbody').html(transactionsHtml);
                    })
                    .catch(function(error) {
                        console.error('Error fetching transactions:', error);
                    });
            }
        });

        $(document).ready(function() {
            $('#printBtn').click(function() {
                if ($('#vendor_id').val() && $('#start_date').val() && $('#end_date').val()) {
                    $('#printModal').modal('hide');
                } else {
                    if (!$('#vendor_id').val()) {
                        $('#vendor_id').addClass('is-invalid');

                    } else {
                        $('#vendor_id').removeClass('is-invalid');
                    }

                    if (!$('#start_date').val()) {
                        $('#start_date').addClass('is-invalid');
                    } else {
                        $('#start_date').removeClass('is-invalid');
                    }

                    if (!$('#end_date').val()) {
                        $('#end_date').addClass('is-invalid');
                    } else {
                        $('#end_date').removeClass('is-invalid');
                    }
                }
            });

            $('#printModal').on('hide.bs.modal', function() {
                $('#vendor_id').removeClass('is-invalid');
                $('#start_date').removeClass('is-invalid');
                $('#end_date').removeClass('is-invalid');
            });
        });


        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue !== '') {
                    $.ajax({
                        url: "{{ route('vendor.index') }}"
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
                    location.href = "{{ route('vendor.index') }}";
                }
            });
        });

    </script>

</body>
</html>
