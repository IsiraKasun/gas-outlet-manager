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
        <nav class="navbar navbar-expand-lg navbar-dark bg-color-primary">
            <div class="container">
                <a class="navbar-brand text-color-white" href="#!">Gas Outlet Manager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        {{$content}}
        <!-- Footer-->
        {{--<footer class="py-5 bg-dark footer">--}}
            {{--<div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>--}}
        {{--</footer>--}}
        <!-- Bootstrap core JS-->
        <script src="{{asset('js/jquery-3.6.3.js')}}"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>

        <script>
            $(document).ready(function () {
                $.ajax('/get-price/' + $('#outlet').val(),
                    {
                        dataType: 'json', // type of response data
                        timeout: 2000,     // timeout milliseconds
                        success: function (data,status,xhr) {   // success callback function
                            $("#largeLabel").html('Large - ' + data.large + ' per unit');
                            $("#mediumLabel").html('Medium - ' + data.medium + ' per unit');
                            $("#smallLabel").html('Small - ' + data.small + ' per unit');

                            $("#largeHidden").val(data.large);
                            $("#mediumHidden").val(data.medium);
                            $("#smallHidden").val(data.small);
                        },
                        error: function (jqXhr, textStatus, errorMessage) { // error callback
                            console.log(jqXhr);
                            console.log(textStatus);
                            console.log(errorMessage);
                        }
                    });

                $.ajax('/get-stock/' + $('#stockOutlet').val(),
                    {
                        dataType: 'json', // type of response data
                        timeout: 2000,     // timeout milliseconds
                        success: function (data,status,xhr) {   // success callback function
                            $("#largeQty").val(data.large);
                            $("#mediumQty").val(data.medium);
                            $("#smallQty").val(data.small);
                        },
                        error: function (jqXhr, textStatus, errorMessage) { // error callback
                            console.log(jqXhr);
                            console.log(textStatus);
                            console.log(errorMessage);
                        }
                    });

                $( "#outlet" ).change(function() {
                    $.ajax('/get-price/' + $('#outlet').val(),
                        {
                            dataType: 'json', // type of response data
                            timeout: 2000,     // timeout milliseconds
                            success: function (data,status,xhr) {   // success callback function
                                $("#largeLabel").html('Large - ' + data.large + ' per unit');
                                $("#mediumLabel").html('Medium - ' + data.medium + ' per unit');
                                $("#smallLabel").html('Small - ' + data.small + ' per unit');

                                $("#largeHidden").val(data.large);
                                $("#mediumHidden").val(data.medium);
                                $("#smallHidden").val(data.small);
                            },
                            error: function (jqXhr, textStatus, errorMessage) { // error callback
                                console.log(jqXhr);
                                console.log(textStatus);
                                console.log(errorMessage);
                            }
                        });
                });

                $( "#stockOutlet" ).change(function() {
                    $.ajax('/get-stock/' + $('#stockOutlet').val(),
                        {
                            dataType: 'json', // type of response data
                            timeout: 2000,     // timeout milliseconds
                            success: function (data,status,xhr) {   // success callback function
                                $("#largeQty").val(data.large);
                                $("#mediumQty").val(data.medium);
                                $("#smallQty").val(data.small);
                            },
                            error: function (jqXhr, textStatus, errorMessage) { // error callback
                                console.log(jqXhr);
                                console.log(textStatus);
                                console.log(errorMessage);
                            }
                        });
                });

                $( "#largeQty" ).keyup(function() {
                    var largeVal = $('#largeQty').val() || 0;
                    var mediumVal = $('#mediumQty').val() || 0;
                    var smallVal = $('#smallQty').val() || 0;

                    var largeUnitPrice = $('#largeHidden').val();
                    var mediumUnitPrice = $('#mediumHidden').val();
                    var smallUnitPrice = $('#smallHidden').val();

                    var orderValue = (largeVal * largeUnitPrice) + (mediumVal * mediumUnitPrice) + (smallVal * smallUnitPrice);
                    $('#orderValue').val(orderValue);
                });

                $( "#mediumQty" ).keyup(function() {
                    var largeVal = $('#largeQty').val() || 0;
                    var mediumVal = $('#mediumQty').val() || 0;
                    var smallVal = $('#smallQty').val() || 0;

                    var largeUnitPrice = $('#largeHidden').val();
                    var mediumUnitPrice = $('#mediumHidden').val();
                    var smallUnitPrice = $('#smallHidden').val();

                    var orderValue = (largeVal * largeUnitPrice) + (mediumVal * mediumUnitPrice) + (smallVal * smallUnitPrice);
                    $('#orderValue').val(orderValue);
                });

                $( "#smallQty" ).keyup(function() {
                    var largeVal = $('#largeQty').val() || 0;
                    var mediumVal = $('#mediumQty').val() || 0;
                    var smallVal = $('#smallQty').val() || 0;

                    var largeUnitPrice = $('#largeHidden').val();
                    var mediumUnitPrice = $('#mediumHidden').val();
                    var smallUnitPrice = $('#smallHidden').val();

                    var orderValue = (largeVal * largeUnitPrice) + (mediumVal * mediumUnitPrice) + (smallVal * smallUnitPrice);
                    $('#orderValue').val(orderValue);
                });
            });
        </script>

    </body>
</html>
