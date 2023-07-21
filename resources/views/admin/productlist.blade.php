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
                    <h3 class="modal-title" id="exampleModalLabel">List</h3>
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

                    <table class="center table table-stripped">
                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($products as $key=>$values)

                            <tr>
                                <td>{{ $no }}.</td>
                                <td>{{ $values->title }}</td>
                                <td>{{ $values->description }}</td>
                                <td><img src="<?php echo url('images/'.$values->image); ?>" width="300"></td>
                                <td>{{ $values->category }}</td>
                                <td>{{ $values->quantity }}</td>
                                <td>{{ $values->price }}</td>
                                <td>{{ $values->discount_price }}</td>

                                <td><a onclick="return confirm('Are you sure to delete this record!')"
                                        class="btn btn-danger"
                                        href="{{ url('productlist_delete',$values->id) }}">Delete</a>
                                    <!-- Button trigger modal -->
                                    <a href="{{ URL('productlist_edit',$values->id) }}" class="btn btn-primary"
                                        data-toggle="modal" data-target="#exampleModal">
                                        Edit
                                    </a>
                                    <?php $no++; ?>
                                    @endforeach

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="/productlist_edit" method="POST"
                                                        enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                value="" id=" exampleInputPassword1">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Description</label>
                                                            <input type="text" class="form-control" name="description"
                                                                value="" id="exampleInputPassword1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Image</label>
                                                            <input type="file" class="form-control" name="image"
                                                                id="exampleInputPassword1">
                                                            <span>Uploaded Image: {{$values->image}}</span>
                                                            <img src="<?php echo url('images/'.$values->image); ?>"
                                                                width="300">
                                                            <input type="hidden" name="image" value="">
                                                        </div>
                                                        <div class=" form-group">
                                                            <label for="exampleInputPassword1">Category</label>

                                                            <select class="form-select form-select-sm"
                                                                aria-label=".form-select-sm example">
                                                                @foreach($category as $value)
                                                                <option value="{{ $value->id}}">
                                                                    {{ $value->category_name}}</option>

                                                                @endforeach
                                                                <input type="hidden" name="category"
                                                                    value="{{$values->id}}">
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Quantity</label>
                                                            <input type="text" class="form-control" name="quantity"
                                                                value="" id="exampleInputPassword1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Price</label>
                                                            <input type="text" class="form-control" name="price"
                                                                value="" id="exampleInputPassword1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Discount price</label>
                                                            <input type="text" class="form-control" value=""
                                                                name="discount_price" id="exampleInputPassword1">
                                                        </div>

                                                        @csrf


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>


                            <div class="pagination">

                            </div>
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