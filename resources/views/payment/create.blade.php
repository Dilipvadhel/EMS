<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        #date::-webkit-calendar-picker-indicator {
            padding-left: 100px;
            border: 1px dashed white;
        }

    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payments</title>
</head>
<body>
    @include('welcome')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <h3> <strong>Create Payment</strong></h3>
                <div class="card">
                    <div class="card-header mt-3">Create Payment</div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="current_balance" class="col-md-4 col-form-label text-md-right text-success">Current Balance :</label>
                            <div class="col-md-6">
                                <input id="current_balance" type="text" class="form-control w-25" readonly>
                            </div>
                        </div>
                        <form   method="POST" action="{{ route('payment.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="vendor_id" class="col-md-4 col-form-label text-md-right">{{ __('Vendor Name') }}</label>
                                <div class="col-md-6">
                                    <select id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror" name="vendor_id" autofocus>
                                        <option value="">Select Vendor</option>
                                        @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" data-balance="{{ $vendor->balance }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                                <div class="col-md-6">
                                    <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="offset-md-4 mr-1">
                                    <button type="submit" class="btn btn-primary">
                                        Payment
                                    </button>
                                    <a href="{{ route('payment.index') }}" class="text-white btn btn-danger">Back</a>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('vendor_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var balance = selectedOption.getAttribute('data-balance');
            document.getElementById('current_balance').value = balance;
        });

    </script>
</body>
</html>