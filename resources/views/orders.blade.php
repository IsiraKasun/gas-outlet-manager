<x-customerbase>

<x-slot name="content">
<!-- Page header with logo and tagline-->
<header class="py-5 bg-color-ternary border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Orders</h1>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    @if ($userType == 'customer')
        <div class="row pb-lg-4">
            <div class="col">
                <a href="/new-order" class="btn btn-primary text-center text-decoration-none">New Order</a>
            </div>
        </div>
    @endif

    <div class="row pt-lg-2">
        <div class="col">
            @isset($errors)
                @if (count($errors) > 0)
                    @foreach ($errors as $error)
                        <p class="text-danger bold">{{$error}}</p>
                    @endforeach
                @endif
            @endisset
            @isset($msgs)
                @if (count($msgs) > 0)
                    @foreach ($msgs as $msg)
                        <p class="text-success bold">{{$msg}}</p>
                    @endforeach
                @endif
            @endisset
        </div>
    </div>
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-12">
            @isset($orders)
                <table class="table table-striped back-color-white">
                    <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Large Qty</th>
                        <th scope="col">Medium Qty</th>
                        <th scope="col">Small Qty</th>
                        <th scope="col">Order Value</th>
                        <th scope="col">Outlet</th>
                        @if ($userType == 'owner')
                            <th scope="col">Paid</th>
                            <th scope="col">Issued</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        @endif
                        @if ($userType == 'customer')
                            <th scope="col">Paid</th>
                            <th scope="col">Received</th>
                            <th scope="col"></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{$order->id}}</th>
                                <td>{{$order->order_date}}</td>
                                <td>{{$order->large_qty}}</td>
                                <td>{{$order->medium_qty}}</td>
                                <td>{{$order->small_qty}}</td>
                                <td>{{$order->order_value}}</td>
                                <td>{{$order->outlet_id}}</td>
                                @if ($userType == 'owner' || $userType == 'customer')
                                    <th scope="col">{{$order->is_paid == '1' ? 'Yes' : 'No'}}</th>
                                    <th scope="col">{{$order->is_issued == '1' ? 'Yes' : 'No'}}</th>
                                @endif
                                @if ($userType == 'owner' && $order->is_paid != '1')
                                    <td><a href="view-outlet/{{$order->id}}" class="form-control btn-danger text-center text-decoration-none">Mark as Paid</a></td>
                                @endif
                                @if ($userType == 'owner' && $order->is_issued != '1')
                                    <td><a href="view-outlet/{{$order->id}}" class="form-control btn-success text-center text-decoration-none">Mark as Issued</a></td>
                                @endif

                                @if ($userType == 'customer' && $order->is_paid != '1')
                                    <td><a href="view-outlet/{{$order->id}}" class="form-control btn-danger text-center text-decoration-none">Pay</a></td>
                                @endif

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            @endisset


        </div>
        <!-- Side widgets-->
    </div>
</div>
</x-slot>
</x-customerbase>