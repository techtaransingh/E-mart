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
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $value)
                        <p class="text-center">{{ $value }}</p>
                    </div>
                    @endforeach
                    @endif
                    @if($success=session('success'))
                    <div class="alert alert-success">
                        <p class="text-center">{{$success}}</p>
                    </div>
                    @endif
                    @if($error=session('error'))
                    <div class="alert alert-danger">
                        <p class="text-center">{{$error}}</p>
                    </div>
                    @endif
                    <div class="div_center">

                        <h2 class="h2_font">Add Product </h2>
                        <form action="/add_product" method="POST" enctype="multipart/form-data">



                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input type="text" class="form-control" name="description" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" class="form-control" name="image" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category</label>

                                <select class="form-select form-select-sm" name="category"
                                    aria-label=".form-select-sm example">
                                    @foreach($category as $value)
                                    <option value="{{ $value->id}}">{{ $value->category_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Quantity</label>
                                <input type="text" class="form-control" name="quantity" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Price</label>
                                <input type="text" class="form-control" name="price" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Discount price</label>
                                <input type="text" class="form-control" name="discount_price"
                                    id="exampleInputPassword1">
                            </div>

                            @csrf
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>




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