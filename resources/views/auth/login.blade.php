<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gas Outlet Manager</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
</head>
<body class="bg-color-secondary">
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg bg-color-primary">
    <div class="container">
        <a class="navbar-brand text-color-white" href="#!">Gas Outlet Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 border-bottom mb-4 bg-color-ternary">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Gas Outlet Manager</h1>
            <p class="lead mb-0">Your convenient Gas Provider</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="{{asset('img/gas.jpg')}}" alt="..." /></a>
            </div>
            <!-- Pagination-->
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header fw-bold">Sign In</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        @foreach ($errors as $error)
                            <p class="text-danger bold">{{$error}}</p>
                        @endforeach
                    @endif
                    @if (count($msgs) > 0)
                        @foreach ($msgs as $msg)
                            <p class="text-success bold">{{$msg}}</p>
                        @endforeach
                    @endif
                    <form method="POST" action="/login">
                        @csrf
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" placeholder="Username" name="username"/>
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control" type="password" placeholder="Password" name="password"/>
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control btn-success" type="submit" value="Sign In" name="submit"/>
                        </div>
                        <div class="input-group mb-3">
                            <a href="/signup" class="form-control btn-warning text-center text-decoration-none">Sign Up</a>
                        </div>
                        {{--<?php--}}
                        {{--if (!empty($success)) { ?>--}}
                        {{--<div class="input-group">--}}
                            {{--<p class="text-success fw-bold"><?php echo($success);?></p>--}}
                        {{--</div>--}}
                        {{--<?php }--}}
                        {{--?>--}}

                        {{--<?php--}}
                        {{--if (!empty($error)) { ?>--}}
                        {{--<div class="input-group">--}}
                            {{--<p class="text-danger fw-bold"><?php echo($error);?></p>--}}
                        {{--</div>--}}
                        {{--<?php }--}}
                        {{--?>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Gas Outlet Manager 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<!-- Core theme JS-->
<script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>