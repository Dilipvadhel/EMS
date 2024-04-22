<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
    @include('welcome')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Category</div>

                    <div class="card-body">
                        <form id="categoryForm" method="POST" action="{{ route('category.update', $category->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row" id="subcategories">
                                        @foreach($category->subcategories as $index => $subcategory)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="subnames[]">Subcategory Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="subnames[]" value="{{ $subcategory->name }}">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-danger" onclick="removeSubcategory(this, {{ $index }})">Remove</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="subIds[]" value="{{ $subcategory->id }}">
                                                <input type="hidden" name="removedSubcategories[]" value="0">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
              
                            <div class="form-group mt-3">
                                <button type="button" class="btn btn-success" onclick="addSubcategory()">Add Subcategory</button>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                                <a href="{{ route('category.index') }}" class="text-white btn btn-danger">Back</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        function addSubcategory() {
            let subcategoriesContainer = document.getElementById('subcategories');
            let newSubcategory = document.createElement('div');
            newSubcategory.classList.add('col-6');
            newSubcategory.innerHTML = `
                <div class="form-group">
                    <label for="subnames[]">Subcategory Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="subnames[]">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger" onclick="removeSubcategory(this)">Remove</button>
                        </div>
                    </div>
                    <input type="hidden" name="subIds[]" value="0">
                    <input type="hidden" name="removedSubcategories[]" value="0">
                </div>
            `;
            subcategoriesContainer.appendChild(newSubcategory);
        }

        function removeSubcategory(button) {
            let subcategoryDiv = button.closest('.col-6');
            let subcategoryIdInput = subcategoryDiv.querySelector('input[name="subIds[]"]');
            let removedSubcategoriesInput = subcategoryDiv.querySelector('input[name="removedSubcategories[]"]');

            if (subcategoryIdInput && subcategoryIdInput.value !== '0') {
                removedSubcategoriesInput.value = '1';
                subcategoryDiv.style.display = 'none';
            } else {
                subcategoryDiv.remove();
            }
        }

    </script>
</body>
</html>
