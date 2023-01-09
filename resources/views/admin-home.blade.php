<?php
include_once('dbConnect.php');
session_start();


$username = $_SESSION["username"];

$stmt = $conn->prepare("SELECT * FROM user WHERE user_id = (SELECT user_id FROM user_credentials WHERE username = ?)");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($row)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
} else {
    $first_name = "";
    $last_name = "";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gas Outlet Manager</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="bg-color-secondary">
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-color-primary">
            <div class="container">
                <a class="navbar-brand text-color-white" href="#!">Gas Outlet Manager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-color-ternary border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome <?php echo($first_name . " " . $last_name); ?>!</h1>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">

                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/300x150/efefef/f66b0e.png&text=CUSTOMERS" alt="..." /></a>
                                <div class="card-body">
                                    <h2 class="card-title h4">Customers</h2>
                                    <p class="card-text">View all customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/300x150/efefef/f66b0e.png&text=OUTLETS" alt="..." /></a>
                                <div class="card-body">
                                    <h2 class="card-title h4">Outlets</h2>
                                    <p class="card-text">Add all outlets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widgets-->
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark footer">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
