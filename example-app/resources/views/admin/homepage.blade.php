<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel-PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light">

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Trang chủ</a>
            </li>
            @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}">Logout</a>
            </li>
            @else
            <li class="nav-item" >
                <a class="nav-link" href="{{route('login')}}" style="display: inline-block; padding:20px; background-color:green;">login</a>
            </li>
            @endif
        </ul>

    </nav>
</body>

</html>