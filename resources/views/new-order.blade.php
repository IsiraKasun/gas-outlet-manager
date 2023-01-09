<x-customerbase>

    <x-slot name="content">
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-color-ternary border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">New Order</h1>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row pb-lg-4">
                <div class="col">
                    <a href="/orders" class="btn btn-primary text-center text-decoration-none">Order History</a>
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
                    <form method="POST" action="/create-order">
                        @csrf
                        <input class="form-control" type="hidden" id="largeHidden"/>
                        <input class="form-control" type="hidden" id="mediumHidden"/>
                        <input class="form-control" type="hidden" id="smallHidden"/>
                        <div class="mb-3 text-white">
                            <label class="form-label">Outlet</label>
                            <select class="form-control" name="outlet" id="outlet">
                                @isset($outlets)
                                    @if (count($outlets) > 0)
                                        @foreach ($outlets as $outlet)
                                            <option value="{{$outlet->id}}">{{$outlet->name}}</option>
                                        @endforeach
                                    @endif
                                @endisset
                            </select>
                        </div>
                        <div class="mb-3 text-white">

                            <label class="form-label" id="largeLabel">Large</label>
                            <input class="form-control" type="number" name="large" id="largeQty"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label" id="mediumLabel">Medium</label>
                            <input class="form-control" type="number" name="medium" id="mediumQty"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label" id="smallLabel">Small</label>
                            <input class="form-control" type="number" name="small" id="smallQty"/>
                        </div>
                        <div class="mb-3 text-white">
                            <label class="form-label">Order Value</label>
                            <input class="form-control" type="number" name="orderValue" value="0" readonly id="orderValue"/>
                        </div>
                        <div class="mb-3">
                            <input class="form-control btn-success" type="submit" value="Submit" name="submit"/>
                        </div>
                    </form>
                </div>
                <!-- Side widgets-->
            </div>
        </div>
        <script>
        </script>

    </x-slot>

</x-customerbase>