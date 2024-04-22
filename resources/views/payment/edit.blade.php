<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('welcome')
    <div class="container mt-5 text-primary">
        <h2 class="text-dark">Edit Payment</h2>
        <div class="card">
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('payment.update', $payment->id) }}" method="POST" id="paymentForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $payment->date }}">
                                @error('date')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $payment->amount }}">
                                @error('amount')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="vendor_id">Vendor Name:</label><br>
                                <select class="form-control mb-3 @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ $payment->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                        <button type="button" id="updatePaymentBtn" class="btn btn-primary mr-2 ml-2">Update Payment</button>
                        <a href="{{ route('payment.index') }}" class="text-white btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('updatePaymentBtn').addEventListener('click', function() {
            document.getElementById('paymentForm').submit();
        });
        
    </script>

    
</body>
</html>