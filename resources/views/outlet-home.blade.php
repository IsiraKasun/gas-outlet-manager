<x-customerbase>

<x-slot name="content">
<header class="py-5 bg-color-ternary border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome {{$fullName}}</h1>
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
                <div class="col-lg-3">
                    <!-- Blog post-->
                    <div class="card mb-3">
                        <a href="#!"><img class="card-img-top" src="{{asset('img/order-history.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">View Orders</h2>
                            <p class="card-text">View all past orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- Blog post-->
                    <div class="card mb-3">
                        <a href="#!"><img class="card-img-top" src="{{asset('img/add-stock.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">Add Stock</h2>
                            <p class="card-text">Add New Stock</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- Blog post-->
                    <div class="card mb-3">
                        <a href="#!"><img class="card-img-top"  src="{{asset('img/sales.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">Sales History</h2>
                            <p class="card-text">View Past Sales</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- Blog post-->
                    <div class="card mb-3">
                        <a href="/outlets"><img class="card-img-top"  src="{{asset('img/manage.png')}}" alt="..." /></a>
                        <div class="card-body">
                            <h2 class="card-title h4">Manage Outlets</h2>
                            <p class="card-text">Add Remove Edit Outlets</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-slot>
</x-customerbase>