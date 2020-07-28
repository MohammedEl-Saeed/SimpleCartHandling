<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <div class="dropdown">
                <?php $total = 0 ; $quantity = 0;?>
                @foreach($cartItems as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                    <?php $quantity += $details['quantity'] ?>
                @endforeach
                <button type="button" class="btn btn-info" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Order Cart <span class="badge badge-pill badge-danger">{{ $quantity }}</span>
                </button>
                <div class="dropdown-menu">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ $quantity }}</span>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                        </div>
                    </div>
                    <div class="cart-item-menu">
                    @if($cartItems)
                        @foreach($cartItems as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img src="{{ $details['photo'] }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <div class="no-items">No Items on Order Cart</div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{  route('orderCart.index') }}" class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <?php $total = 0 ; $quantity = 0;?>
                @foreach($wishItems as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                    <?php $quantity += $details['quantity'] ?>
                @endforeach
                <button type="button" class="btn btn-info" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Wishlist Cart <span class="badge badge-pill badge-danger">{{ $quantity }}</span>
                </button>
                <div class="dropdown-menu">
                <div class="row total-header-section">
                    <div class="col-lg-6 col-sm-6 col-6">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ $quantity }}</span>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                        <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                    </div>
                </div>
                <div class="cart-item-menu">
                @if($wishItems)
                    @foreach($wishItems as $id => $details)
                        <div class="row cart-detail">
                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                <img src="{{ $details['photo'] }}" />
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <p>{{ $details['name'] }}</p>
                                <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                        <div class="no-items">No Items on Wishlist Cart</div>
                @endif
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                        <a href="{{ route('wishListCart.index') }}" class="btn btn-primary btn-block">View all</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="container page">
    @yield('content')
</div>
<script src="{{URL::asset('asset/js/bootstrap.min.js')}}"></script>

@yield('scripts')

</body>
</html>
