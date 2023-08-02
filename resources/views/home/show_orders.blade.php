<?php 
      use Illuminate\Support\Facades\Auth;
      $user = auth::user();
      ?>

<!DOCTYPE html>
<html>
<style>
.gradient-custom {
    /* fallback for old browsers */
    background: #dc3545;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to top left, rgba(255, 255, 255), rgba(220, 53, 69));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to top left, rgba(255, 255, 255), rgba(220, 53, 69))
}
</style>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="home/images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-10 col-xl-8">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-header px-4 py-5">
                                <h5 class="text-muted mb-0">Thanks for your Order, <span
                                        style="color: #a8729a;">{{$user->name}}</span>!</h5>
                            </div>

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
                                    <p class="small text-muted mb-0">Receipt Voucher : 1KAU9-84UIL</p>
                                </div>
                                @if($message=session('message'))
                                <div class="alert alert-success">
                                    <p class="text-center">{{$message}}</p>
                                </div>
                                @endif
                                @foreach($orders as $value)

                                <div class="card shadow-0 border mb-4">

                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-2">

                                                <img src="{{ URL('images',$value->image)}}" class="img-fluid"
                                                    alt="Phone">
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">{{$value->product_title}}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{$value->name}}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{$value->email}}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{$value->phone}}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{$value->address}}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Qty: {{$value->quantity}}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Rs {{$value->price}}</p>
                                            </div>
                                        </div>
                                        <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-2">
                                                <p class="text-muted mb-0 small">Track Order</p>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="progress" style="height: 6px; border-radius: 16px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: 65%; border-radius: 16px; background-color: #a8729a;"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="d-flex justify-content-around mb-1">
                                                    <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivery</p>
                                                    <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                        {{$value->delivery_status}}</p>
                                                    <?php if($value->delivery_status == 'delivered' || $value->delivery_status =='Cancelled' ){
                                                        echo 'Cancellation Not Allowed';
                                                    } else 
                                                    {?>
                                                    <a href="{{URL('cancel_order',$value->id)}}">Cancel order</a>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach


                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">Order Details</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> $898.00</p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0">Invoice Number : 788152</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $19.00</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Invoice Date : 22 Dec,2019</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
                                </div>

                                <div class="d-flex justify-content-between mb-5">
                                    <p class="text-muted mb-0">Recepits Voucher : 18KU-62IIK</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free
                                    </p>
                                </div>
                            </div>
                            <div class="pagination"
                                style="margin-top:45px;padding-top:20px;text-align:center;display:flex;justify-content:center;align-items:center">
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </div>
                            <div class="card-footer border-0 px-4 py-5"
                                style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <h5
                                    class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                                    Total
                                    paid: <span class="h2 mb-0 ms-2">$1040</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('home.footer')
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
        </div>
        <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
</body>

</html>

</html>