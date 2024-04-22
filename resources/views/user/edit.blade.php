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
    <title>Update User Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>  
    @include('welcome');
    <div class="container mt-5">
        <h2 class="mb-3">Edit User Registration</h2>
        <form id="updateForm" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-6">
                    @if($user->profile_picture)
                    <div>
                        <label>Profile Picture :</label>
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" style="max-width: 50px; max-height: 50px;">
                    </div>
                    @endif
                    <input type="file" class="form-control mt-2 @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture" value="{{ old('profile_picture', $user->profile_picture) }}">
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="role_id">Select Role</label>
                        <select name="role_id" id="role_id" class="form-control mt-2">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}">
                        <span id="firstnameError" class="error"></span><br>
                        @error('firstname')
                        <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control  @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}">
                        <span id="lastnameError" class="error"></span><br>
                        @error('lastname')
                        <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                        <span id="emailError" class="error"></span><br>
                        @error('email')
                        <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                        <span id="usernameError" class="error"></span><br>
                        @error('username')
                        <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="updateBtn">update</button>
            <a href="{{route('user.index')}}" class="text-white btn btn-danger">Back</a>
        </form>
    </div>
</body>
</html>
