<x-customerbase>

<x-slot name="content">
<!-- Page header with logo and tagline-->
<header class="py-5 bg-color-ternary border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome {{$fullName}}!</h1>
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
                <div class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="/new-order"><img class="card-img-top" src="{{asset('img/new-order.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">Order Now</h2>
                            <p class="card-text">Order New Gas from a selected outlet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="/orders"><img class="card-img-top" src="{{asset('img/order-history.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">View Orders</h2>
                            <p class="card-text">View all past orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="/outlets"><img class="card-img-top" src="{{asset('img/shop.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">View Outlets</h2>
                            <p class="card-text">View all outlets</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Side widgets-->
    </div>
</div>
</x-slot>
</x-customerbase>