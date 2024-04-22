<!DOCTYPE html>
{{-- resources/views/role/edit.blade.php --}}
<html lang="en">
<head>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Role</title>
</head>
<body>
    @include('welcome')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3>
                    <strong>
                        Edit Role
                    </strong>
                </h3>

                <div class="card">
                    <div class="card-header mt-3">Edit Role</div>
                    <div class="card-body">
                        <form action="{{ route('role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><i class='fab fa-creative-commons-by'></i>
                                    Role Name
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}">
                                    @error('name')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="offset-md-4 col-md-6">
                                    <button type="submit" class="btn btn-primary">Update Role</button>
                                    <a href="{{ route('role.index') }}" class="text-white btn btn-danger">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
