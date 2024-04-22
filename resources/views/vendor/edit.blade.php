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
    <title>Edit Vendor Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('welcome');
    <div class="container mt-5">
        <h2>Edit Vendor Registration</h2>
        <form id="editForm" action="{{ route('vendor.update', $vendor->id) }}" method="POST" onsubmit="return validateEditForm()">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="vendor_name">Vendor Name</label>
                        <input type="text" class="form-control @error('vendor_name') is-invalid @enderror" id="vendor_name" name="vendor_name" value="{{ old('vendor_name', $vendor->vendor_name) }}">
                        <span id="vendor_nameError" class="error"></span><br>
                        @error('vendor_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $vendor->company_name) }}">
                        <span id="company_nameError" class="error"></span><br>
                        @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="mobile_no">Mobile Number</label>
                        <input type="text" maxlength="10" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $vendor->mobile_no) }}">
                        <span id="mobile_noError" class="error"></span><br>
                        @error('mobile_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

             <div class="row">
             <div class="col-6">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $vendor->address) }}">
                <span id="addressError" class="error"></span><br>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

             <div class="col-6">
            <div class="form-group">
                <label for="email">Vendor Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $vendor->email) }}">
                <span id="emailError" class="error"></span><br>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('vendor.index') }}" id="ch" class="text-white btn btn-danger ">Back</a> </div>

        </form>
    </div>

    <script>
        function validateEditForm() {
            let isValid = true;
            let store = ["vendor_name", "company_name", "mobile_no", "address", "email"];
            let mobile = document.getElementById("mobile_no");

            store.forEach(function(fieldId) {
                let field = document.getElementById(fieldId);
                let errorSpan = document.getElementById(fieldId + "Error");

                if (field.value.trim() === "") {
                    errorSpan.textContent = fieldId + "This field is required";
                    isValid = false;
                } else if (mobile.value.trim().length < 10) {
                    let errorSpan = document.getElementById("mobile_noError");
                    errorSpan.textContent = "minmum 10 number are Reuired";
                    isValid = false;
                } else {
                    errorSpan.textContent = "";
                }
            });

            return isValid;
        }

    </script>
</body>
</html>
