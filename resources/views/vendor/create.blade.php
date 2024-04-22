<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .error {
            color: red;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    @include('welcome')
    <div class="container text-primary">
        <h2 class="text-dark mb-3">Vendor Registration</h2>
        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('vendor.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="vendor_name">Vendor Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('vendor_name') is-invalid @enderror" id="vendor_name" name="vendor_name">
                                </div>
                                <span id="vendor_nameError" class="error"></span><br>
                                @error('vendor_name')
                                    <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control  @error('company_name') is-invalid @enderror" id="company_name" name="company_name">
                                </div>
                                <span id="company_nameError" class="error"></span><br>
                                @error('company_name')
                                    <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mobile_no">Mobile Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" maxlength="10" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no">
                                </div>
                                <span id="mobile_noError" class="error"></span><br>
                                @error('mobile_no')
                                    <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address">
                                </div>
                                <span id="addressError" class="error"></span><br>
                                @error('address')
                                    <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Vendor Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                </div>
                                <span id="emailError" class="error"></span><br>
                                @error('email')
                                    <div class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="{{ route('vendor.index') }}" class="text-white btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            let isValid = true;
            let fieldCheck = [
                { key: 'vendor_name', rules: { required: true, msg: 'Vendor name is required' } },
                { key: 'company_name', rules: { required: true, msg: "Company Name is required" } },
                { key: 'mobile_no', rules: { required: true, length: 10, msg: "Mobile number is required" }, lengthMsg: "Mobile numbers are 10 Digit" },
                { key: 'address', rules: { required: true, msg: "Address Name is required" } },
                { key: 'email', rules: { required: true, msg: "Email Name is required" } },
           ];

            fieldCheck.forEach(field => {
                let value = document.getElementById(field.key).value.trim();
                let errorSpan = document.getElementById(field.key + 'Error');
                errorSpan.innerText = '';
                if (field.rules.required && value === '') {
                    errorSpan.innerText = field.rules.msg;
                    isValid = false;
                } else if (field.rules.length && value.length !== field.rules.length) {
                    errorSpan.innerText = field.lengthMsg;
                    isValid = false;
                }
            });
            return isValid;
        }
    </script>
</body>
</html>
