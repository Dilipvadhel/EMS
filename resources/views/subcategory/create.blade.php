<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .error {
            color: red;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subcategory Registration</title>
</head>
<body>
    @include('welcome')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Subcategory</div>

                    <div class="card-body">
                        <form id="subcategoryForm" method="POST" action="{{ route('subcategory.store') }}" onsubmit="return validateSubcategoryForm()">
                            @csrf

                            <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">Category</label>
                                <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <span id="categoryError" class="error"></span>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Subcategory Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    <span id="subcategoryNameError" class="error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">{{ old('description') }}</textarea>
                                    <span id="descriptionError" class="error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateSubcategoryForm() {
            let isValid = true;
            let fields = ["category_id", "name"];

            fields.forEach(function(fieldId) {
                let field = document.getElementById(fieldId);
                let errorSpan = document.getElementById(fieldId + "Error");

                if (field.value === "") {
                    errorSpan.textContent = fieldId === "category_id" ? "Category is required" : "Subcategory name is required";
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