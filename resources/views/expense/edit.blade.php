<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('welcome')
    <div class="container mt-5 text-primary">
        <h2 class="text-dark">Edit Expense</h2>
        <div class="card">
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('expense.update', $expense->id) }}" method="POST" id="expenseForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $expense->date }}">
                                @error('date')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $expense->amount }}">
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
                                        <option value="{{ $vendor->id }}" {{ $expense->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Category :</label>
                                <select class="form-control mb-3 @error('category') is-invalid @enderror" id="category" name="category">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="subcategory">SubCategory :</label>
                                <select class="form-control mb-3 @error('subcategory') is-invalid @enderror" id="subcategory" name="subcategory">
                                    <option value="">Select SubCategory</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $expense->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary mr-2 ml-2">Update Expense</button>
                        <a href="{{ route('expense.index') }}" class="text-white btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    const categoryInput = document.getElementById('category');
    const subCategoriesInput = document.getElementById('subcategory');

    var subCategories = {!! json_encode($subcategories->toArray()) !!};

    categoryInput.addEventListener('change', function() {
        let selectedSubCategories = [];

        subCategories.forEach((subCategory) => {
            if (subCategory.category_id === categoryInput.value) {
                selectedSubCategories.push(subCategory);
            }
        });

        subCategoriesInput.innerHTML = '';
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Select SubCategory';
        subCategoriesInput.appendChild(defaultOption);

        selectedSubCategories.forEach((subCategory) => {
            const option = document.createElement('option');
            option.value = subCategory.id;
            option.text = subCategory.subcategory_name;
            subCategoriesInput.appendChild(option);
        });
    });

</script>
