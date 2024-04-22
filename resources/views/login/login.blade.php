<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {

            background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
            /* background-repeat: no-repeat; */
            /* background-size: cover; */
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .card {
            height: 390px;
            margin-top: 15%;
            margin-bottom: auto;
            width: 640px;
            background-color: rgba(253, 242, 242, 0.5) !important;
            
        }

        .card-header {
            background-color: #4788bc;
            color: #fff;
        }

        .btn-primary {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .form-group label {
            font-weight: bold;
        }

    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 mt-5">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-header  text-light">
                        <i class="fas fa-sign-in-alt"></i> Expense Manage
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username"><i class="fas fa-user"></i> Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                                @error('username')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                                @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="form-check checkbox">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;">
                                    <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
                            {{-- <a href="{{ route('user.create') }}" class="text-white btn btn-primary">New User Registration</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Font Awesome script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
