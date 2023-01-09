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
            <div class="row pb-lg-4">
                <div class="col">
                    <a href="/outlets" class="btn btn-primary text-center text-decoration-none">View Outlets</a>
                </div>
            </div>
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
                <div class="col-lg-5">
                    <form method="POST" action="/create-outlet">
                        @csrf

                        <div class="mb-3 text-white">
                            <label class="form-label">Outlet Name</label>
                            <input class="form-control" type="text" name="name"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text" name="address"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label">Telephone</label>
                            <input class="form-control" type="number" name="telephone"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label">Longitude</label>
                            <input class="form-control" type="number" name="lan"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label">Latitude</label>
                            <input class="form-control" type="number" name="lat"/>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isDeliveryAvailable" value="1">
                            <label class="form-check-label">
                                Delivery Available
                            </label>
                        </div>
                        <div class="mb-3">
                            <input class="form-control btn-success" type="submit" value="Submit" name="submit"/>
                        </div>
                    </form>
                </div>
                <!-- Side widgets-->
            </div>
        </div>
    </x-slot>
</x-customerbase>