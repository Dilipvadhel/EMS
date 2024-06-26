<!DOCTYPE html>
<html lang="en">
{{-- resources/views/role/create.blade.php --}}
<head>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Roles</title>
</head>
<body>
    @include('welcome')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3>
                    <strong>
                        Create New Role
                    </strong>
                </h3>

                <div class="card">
                    <div class="card-header mt-3">Create Role</div>
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><i class='fab fa-creative-commons-by'></i>
                                    Role Name
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="offset-md-4 col-md-6">
                                    <button type="submit" class="btn btn-primary">Create Role</button>
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
