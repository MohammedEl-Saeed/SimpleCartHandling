@extends('layouts.layout',['cartItems' => $cartItems])

@section('title', 'Cart')

@section('content')

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:10%">Type</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>

        @if(isset($cartItems) && count($cartItems) > 0)
{{--        @if(session('cart'))--}}
{{--            @foreach(session('cart') as $id => $details)--}}
            @foreach($cartItems as $id => $cartItem)
                @php $total += $cartItem['price'] * $cartItem['quantity'] @endphp
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $cartItem['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $cartItem['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $cartItem['price'] }}</td>
                    <td data-th="Price">{{ $cartItem['type'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $cartItem['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $cartItem['price'] * $cartItem['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" id="update-{{$cartType}}" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" id="remove-from-{{$cartType}}" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{ $total }}</strong></td>
        </tr>
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td><a href="{{ url("/clear-$cartType") }}" class="btn btn-danger"><i class="fa fa-eraser"></i> empty Cart</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong></td>
        </tr>
        </tfoot>
    </table>

@endsection

@section('scripts')
    <script type="text/javascript">

        $("#update-order-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('orderCart.update') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $("#update-wish-list-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('wishListCart.update') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $("#remove-from-order-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ route('orderCart.delete') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

        $("#remove-from-wish-list-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ route('wishListCart.delete') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>
@endsection
