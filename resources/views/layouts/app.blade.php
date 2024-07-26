<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .nav-item .btn-box {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            color: #333;
        }
        .nav-item .btn-box:hover {
            background-color: #e2e6ea;
            color: #0056b3;
        }
        .nav-item .btn-box .fa {
            margin-right: 5px;
        }
    </style>
    <title>@yield('title', 'Your Application')</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="images/logo.png" alt="Logo" style="height: 40px; margin-left:130px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="margin-right:130px;">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn-box" href="{{ url('/') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="btn-box" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn-box" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="btn-box">
                            <i class="fas fa-user"></i> Welcome, {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn-box" href="{{ route('logout') }}" onclick="event.preventDefault(); logout();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script>
        function logout() {
            document.getElementById('logout-form').submit();
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
