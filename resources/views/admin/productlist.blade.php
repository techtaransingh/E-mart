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
                            <?php 
                            $no = 1; 
                            $productId = [];
                        ?>
                            @foreach($products as $key=>$values)

                            <tr id="edit_todo_{{ $values->id }}">
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
                                    <!-- <a href="{{ URL('productlist_edit',$values->id) }}" class="btn btn-primary">
                                        Edit
                                    </a> -->
                                    <button type="button" id="edit_todo" data-id="{{ $values->id}}" class="btn btn-info"
                                        onclick="editThisProduct({{ $values->id}})">Edit</button>
                                </td>

                                <?php $no++; ?>
                                @endforeach
                            </tr>
                            <!-- Modal -->
                            <div class="modal" id="modal_todo">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="form_to_do">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modal title</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p>Modal body text goes here.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                            $("#edit_todo").on('click', function() {
                                $("#modal_todo").modal('show');
                            });
                            </script>


                            <div class="pagination">

                            </div>
                        </tbody>
                </div>
                </table>



            </div>
        </div>
        <!--content - wrapper ends-->
        <!--partial: partials / _footer.html-->
        @include('admin.footer')
        <!--partial-->
    </div>
    <!--main - panel ends-->
    </div>
    <!--page - body - wrapper ends-->
    </div>
    <!--container - scroller-->
    @include('admin.script')

    <script>
    function editThisProduct(e) {
        console.log('editThisProduct', e);

        // $.ajax({
        //     type: 'GET',
        //     dataType: "jsonp",
        //     url: "https://dummy.restapiexample.com/api/v1/employee/1" + e,
        //     success: function(data, status, xhr) {
        //         console.log('data: ', data);
        //     }
        // });


    }
    </script>

</body>

</html>