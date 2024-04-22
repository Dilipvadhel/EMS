<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .error {
        color: red;

    }

</style>
<body>
    @include('welcome')

    <div class="container text-primary mb-5">
        <h2 class="text-dark">User Registration</h2>
        <div class="card">
            <div class="card-body">
                <form id="userForm" action="{{ route('user.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateUserForm()">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture" value="{{ old('profile_picture') }}">
                                </div>
                                <span id="profile_pictureError" class="error"></span><br>
                                @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="role_id">Select Role</label>
                            <select name="role_id" id="role_id" class="form-control mb-3 @error('role_id') is-invalid @enderror" value="{{ old('role_id') }}">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <span id="role_idError" class="error"></span><br>
                            @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control  @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}">
                                </div>
                                <span id="firstnameError" class="error"></span><br>
                                @error('firstname')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control  @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                                </div>
                                <span id="lastnameError" class="error"></span><br>
                                @error('lastname')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                                </div>
                                <span id="usernameError" class="error"></span><br>
                                @error('username')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                </div>
                                <span id="emailError" class="error"></span><br>
                                @error('email')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password">
                                </div>
                                <span id="passwordError" class="error"></span><br>
                                @error('password')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                </div>
                                <span id="password_confirmationError" class="error"></span><br>
                                @error('password_confirmation')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="{{route('user.index')}}" class="text-white btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateUserForm() {
            let isValid = true;
            let fields = ["profile_picture", "role_id", "firstname", "lastname", "username", "email", "password", "password_confirmation"];

            fields.forEach(function(fieldId) {
                let field = document.getElementById(fieldId);
                let errorSpan = document.getElementById(fieldId + "Error");

                if (field.value.trim() === "") {
                    errorSpan.textContent = fieldId + "This field is required";
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
