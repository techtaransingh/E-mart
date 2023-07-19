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

                        <h2 class="h2_font">Add Category </h2>
                        <form action="add/category" method="POST">


                            <input type="text" name="category_name" class="input_color" id="exampleInputEmail1"
                                aria-describedby="emailHelp">

                            @csrf
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <table class="center table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($category_list as $key=>$values)
                                <tr>

                                    <td>{{ $values->category_name }}</td>
                                    <td><a class="btn btn-danger" href="/category_delete/{{ $values->id }}">Delete</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{ $category_list->links() }}
                        </div>
                    </div>


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