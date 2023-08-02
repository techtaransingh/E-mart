<!DOCTYPE html>
<html lang="en">

<head>

    <style>
    .div_center {
        text-align: center;
        padding-top: 40px;
    }

    .h2_font {
        font-size: 40px;
        padding-bottom: 40px;
    }

    .input_color {
        color: black;
    }

    .center {
        margin: auto;
        text-align: center;
        margin-top: 30px;
        width: 50% !important;
        text color: white;
        border: 3px solid white;
    }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    @include('admin.css')
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="div_center">
                        @if($message=session('message'))
                        <div class="alert alert-success">
                            <p class="text-center">{{$message}}</p>
                        </div>
                        @endif



                        <h2 class="h2_font">Order List </h2>
                        <div style="padding-bottom:20px;padding-top:20px">
                            <form action="search_order" method="post">
                                <input type="text" name='search' value="{{old('search')}}" placeholder="Search..">
                                <button class="btn bth-primary btn-success">Submit</button>
                                @csrf
                            </form>
                        </div>


                        <table class="table table-dark"
                            style="overflow-x:auto;white-space:nowrap;display:block;width:100%">
                            <thead>
                                <tr>
                                    <th scope=" col">S.No.</th>
                                    <th scope="col">Name</th>

                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>

                                    <th scope="col">Product Title</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>

                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Delivery Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($order as $key=>$values)
                                <tr>
                                    <td>{{ $no }}.</td>
                                    <td>{{ $values->name }}</td>

                                    <td>{{ $values->phone }}</td>
                                    <td>{{ $values->address }}</td>

                                    <td>{{ $values->product_title }}</td>
                                    <td>{{ $values->quantity }}</td>
                                    <td>{{ $values->price }}</td>
                                    <td><img src="{{ URL('images',$values->image)}}" width="300"></td>

                                    <td>{{ $values->payment_status }}</td>
                                    <td>{{ $values->delivery_status }}</td>

                                    <td>
                                        <?php
                                        if(($values->payment_status =='Paid by cash'|| $values->payment_status =='Paid by card') AND $values->delivery_status=='delivered'){ ?>

                                        <span style="color:yellow">Delivered</span>
                                        <?php } else{
                                        ?>
                                        <a onclick="return confirm('Are you sure to update the status!')"
                                            class="btn btn-danger"
                                            href="{{ url('delivered',$values->id) }}">Delivered</a>
                                        <?php }?>
                                        <a href="{{ URL('print_pdf',$values->id) }}" class="btn btn-primary">Receipt</a>
                                    </td>


                                </tr>
                                <?php $no++; ?>
                                @endforeach

                            </tbody>
                    </div>
                    </table>



                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('admin.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>