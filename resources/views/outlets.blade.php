<x-customerbase>

<x-slot name="content">
<!-- Page header with logo and tagline-->
<header class="py-5 bg-color-ternary border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Outlets</h1>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    @if ($userType == 'owner')
        <div class="row pb-lg-4">
            <div class="col">
                <a href="/add-outlet" class="btn btn-primary text-center text-decoration-none">Add Outlet</a>
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
            @isset($outlets)
                <table class="table table-striped back-color-white">
                    <thead>
                    <tr>
                        <th scope="col">Outlet ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Delivery Available</th>
                        @if ($userType == 'owner')
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($outlets) > 0)
                        @foreach ($outlets as $outlet)
                            <tr>
                                <th scope="row">{{$outlet->id}}</th>
                                <td>{{$outlet->name}}</td>
                                <td>{{$outlet->address}}</td>
                                <td>{{$outlet->tel}}</td>
                                <td>{{$outlet->is_delivery_avail == '1' ? 'Yes' : 'No'}}</td>
                                @if ($userType == 'owner')
                                    <td><a href="view-outlet/{{$outlet->id}}" class="form-control btn-success text-center text-decoration-none">View</a></td>
                                    <td><a href="edit-outlet/{{$outlet->id}}" class="form-control btn-warning text-center text-decoration-none">Edit</a></td>
                                    <td><a href="delete-outlet/{{$outlet->id}}" class="form-control btn-danger text-center text-decoration-none">Delete</a></td>
                                    <td><a href="change-price/{{$outlet->id}}" class="form-control btn-primary text-center text-decoration-none">Change Price</a></td>
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