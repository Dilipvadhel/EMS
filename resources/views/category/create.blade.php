<style>
    .error {
        color: red;
        font-size: 100%;
        font-family: bold;
    }

</style>
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="categoryForm">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control   @error('name') is-invalid @enderror" id="name" name="name">
                        <span id="categoryNameError" class="error"></span><br>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row" id="subcategories">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="subnames[]">Subcategory Name</label>
                                        <button type="button" class="btn btn-success ml-2 mb-2  @error('subnames[]') is-invalid @enderror" onclick="addSubcategory()">Add Subcategory</button>
                                        <span id="subcategoryError" class="error"></span><br>
                                        @error('subnames.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnCreateCategory">Create Category</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
    const btnCreateCategory = document.getElementById("btnCreateCategory");

    btnCreateCategory.addEventListener("click", validateCategoryForm);

    function validateCategoryForm() {
        let isValid = true;
        document.querySelectorAll('.error').forEach(error => error.textContent = '');

        let categoryName = document.getElementById("name").value.trim();
        let categoryNameError = document.getElementById("categoryNameError");
        if (categoryName === "") {
            categoryNameError.textContent = "Category Name is Required";
            isValid = false;
        } else {
            categoryNameError.textContent = "";
        }

        let subcategories = document.querySelectorAll('input[name="subnames[]"]');
        let subcategoryCount = 0;
        subcategories.forEach(subcategory => {
            let subcategoryName = subcategory.value.trim();
            let errorSpan = subcategory.parentElement.querySelector('.error');
            if (subcategoryName === "") {
                errorSpan.textContent = "Subcategory name is required";
                isValid = false;
            } else {
                subcategoryCount++;
                errorSpan.textContent = "";
            }
        });

        let subcategoryError = document.getElementById("subcategoryError");
        if (subcategoryCount === 0 && subcategories.length <= 0) {
            subcategoryError.textContent = "Minimum one Subcategory required";
            isValid = false;
        } else {
            subcategoryError.textContent = "";
        }

        if (isValid) {
            submitCategoryForm();
        }
    }

    function submitCategoryForm() {
        let formData = new FormData(document.getElementById('categoryForm'));
        axios.post('{{ route("category.store") }}', formData)
            .then(function(response) {
                console.log(response.data);
                window.location.reload();
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    function addSubcategory() {
        let subcategoriesContainer = document.getElementById('subcategories');
        let newSubcategory = document.createElement('div');
        newSubcategory.classList.add('form-group');
        newSubcategory.innerHTML = `
            <div class="row mb-2">
                <div class="col-9">
                    <input type="text" class="form-control" name="subnames[]">
                    <input type="hidden" name="subIds[]" value="0">
                    <input type="hidden" name="removedSubcategories[]" value="0">
                    <span class="error"></span>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-danger" onclick="removeSubcategory(this)">Remove</button>
                </div>
            </div>
        `;
        subcategoriesContainer.appendChild(newSubcategory);
    }

    function removeSubcategory(button) {
        let subcategoryDiv = button.closest('.row');
        subcategoryDiv.parentNode.removeChild(subcategoryDiv);
    }

</script>
