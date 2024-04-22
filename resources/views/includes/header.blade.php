<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>
    .dropdown-toggle::after {
        display: none !important;
    }

</style>

<nav class="navbar navbar-expand-lg" style="margin-top: -80px; background-color:#393e46;margin-left:0.7%;">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 109%; margin-top:12px;">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 36px; height: 36px; border-radius: 50%;">
                        @else
                        <i class='fas fa-user-circle' style='font-size:36px;color:springgreen'></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#userModal"><i class='fas fa-user-check' style='font-size:24px'></i> {{ Auth::user()->username }}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{route('user.create')}}"><i class="fas fa-users text-lights mb-2 mr-1"></i> Registration</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-light" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
