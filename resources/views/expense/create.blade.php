<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Expense</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .error{
        color: red;
    }
    #date::-webkit-calendar-picker-indicator {
            padding-left: 100px;
            border: 1px dashed white;
        }
</style>
<body>

    @include('welcome');
    <div class="container mt-5 text-primary">
        <h2 class="text-dark">Create Expense</h2>
        <div class="card">
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('expense.store') }}" method="POST" id="expenseForm" onsubmit="return validateExpenseForm()">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date">
                                <div id="dateError" class="error"></div>
                                @error('date')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount">
                                <div id="amountError" class="error"></div>
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
                                        <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                    @endforeach
                                </select>
                                <div id="vendor_idError" class="error"></div>
                                @error('vendor_id')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Category :</label>
                                <select class="form-control mb-3 @error('category') is-invalid @enderror" id="category" name="category">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div id="categoryError" class="error"></div>
                                @error('category')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="subcategory">SubCategory :</label>
                                <select class="form-control mb-3 @error('subcategory') is-invalid @enderror" id="subcategory" name="subcategory">
                                    <option value="">Select SubCategory</option>
                                </select>
                                <div id="subcategoryError" class="error"></div>
                                @error('subcategory')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary mr-2 ml-2">Create Expense</button>
                        <a href="{{ route('expense.index') }}" class="text-white btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const categoryInput = document.getElementById('category');
        const subCategoriesInput = document.getElementById('subcategory');

        var subCategories = {!! json_encode($subcategories->toArray()) !!};

        categoryInput.addEventListener('change', function() {
            let selectedSubCategories = subCategories.filter(subCategory => subCategory.category_id == categoryInput.value);

            subCategoriesInput.innerHTML = '<option value="">Select SubCategory</option>';
            selectedSubCategories.forEach(subCategory => {
                subCategoriesInput.innerHTML += `<option value="${subCategory.id}">${subCategory.name}</option>`;
            });
        });

        function validateExpenseForm() {
            let isValid = true;
            let fields = ["date", "amount", "vendor_id", "category", "subcategory"];

            fields.forEach(function(fieldId) {
                let field = document.getElementById(fieldId);
                let errorSpan = document.getElementById(fieldId + "Error");

                if (fieldId === "date" && field.value === "") {
                    errorSpan.textContent = "Date is required";
                    isValid = false;
                } else if (fieldId === "amount" && field.value === "") {
                    errorSpan.textContent = "Amount is required";
                    isValid = false;
                } else if ((fieldId === "vendor_id" || fieldId === "category" || fieldId === "subcategory") && field.value === "") {
                    errorSpan.textContent = fieldId + " is required";
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
