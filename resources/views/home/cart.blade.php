<?php 
 $wcp_price = 0;
 $price_diff = 0;
 $price_without_discount = 0;
 $price_with_discount = 0;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Cart</title>
</head>

<body>

    <style>
    body {
        margin-top: 20px;
        background: #eee;
    }

    .ui-w-40 {
        width: 40px !important;
        height: auto;
    }

    .card {
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
    }

    .ui-product-color {
        display: inline-block;
        overflow: hidden;
        margin: .144em;
        width: .875rem;
        height: .875rem;
        border-radius: 10rem;
        -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
        vertical-align: middle;
    }
    </style>
    <div class="container px-3 my-5 clearfix">
        <!-- Shopping cart table -->
        <div class="card">
            <div class="card-header">
                <h2>Shopping Cart</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <!-- Set columns width -->
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details
                                </th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#"
                                        class="shop-tooltip float-none text-light" title=""
                                        data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($cart as $value){ ?>
                            <tr>
                                <?php $wcp_price = $wcp_price + (($value->price) * ($value->quantity)); ?>
                                <td class="p-4">
                                    <div class="media align-items-center">
                                        <img src="{{ URL('/images', $value->image)}}"
                                            class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                        <div class="media-body">
                                            <a href="{{ URL('product_details',$value->product_id) }}"
                                                class="d-block text-dark">{{$value->product_title}}</a>
                                            <small>

                                                <?php foreach($product as $values){ ?>
                                                <?php foreach($values as $values3){ 
                                                 if($values3->id == $value->product_id)
                                                {?>
                                                <span class="text-muted">Description:{{ $values3->description }}</span>
                                                <span style="color:red;text-decoration:line-through"
                                                    class="text-muted">Price:₹{{ $values3->price}}</span>
                                                <?php $price_diff =$price_diff +($value->quantity * ($values3->price - $values3->discount_price));
                                                $price_without_discount =   $price_without_discount + ($value->quantity * $values3->price);
                                                $price_with_discount = $price_with_discount + ($value->quantity * $values3->discount_price );
                                                $discount_percentage = ((($price_without_discount - $price_with_discount )/$price_without_discount)*100);
                                                ?>

                                                <?php  }  ?>
                                                &nbsp;
                                                <?php }
                                                }?>

                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right font-weight-semibold align-middle p-4">₹{{$value->price}}
                                </td>
                                <td class="align-middle p-4"><input type="text" class="form-control text-center"
                                        value="{{ $value->quantity}}">
                                </td>
                                <td class="text-right font-weight-semibold align-middle p-4">
                                    <?php echo '₹'.($value->price) * ($value->quantity);?>
                                </td>
                                <td class="text-center align-middle px-0"><a
                                        onclick="return confirm('Are you sure to remove from cart')"
                                        href="{{URL('delete_product',$value->id)}}"
                                        class="shop-tooltip close float-none text-danger" title=""
                                        data-original-title="Remove">×</a></td>

                            </tr>
                            <?php } ?>
                            <tr>




                        </tbody>
                    </table>
                </div>
                <!-- / Shopping cart table -->

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="mt-4">
                        <label class="text-muted font-weight-normal">Promocode</label>
                        <input type="text" placeholder="ABC" class="form-control">
                    </div>
                    <div class="text-right mt-4">
                        <label style="color:red;text-decoration:line-through"
                            class="text-muted font-weight-normal m-0">Items</label>

                        <div style="color:red;text-decoration:line-through" class="text-large">
                            <strong>₹{{ $price_without_discount }}</strong>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="text-right mt-4 mr-5">
                            <label class="text-muted font-weight-normal m-0">Discount</label>
                            <div class="text-large"><strong>{{ $discount_percentage }}% {{ $price_diff }}</strong></div>
                        </div>
                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">Total price</label>

                            <div class="text-large"><strong>₹{{ $wcp_price }}</strong></div>
                        </div>
                    </div>
                </div>

                <div class="float-right">
                    <!-- <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to
                        shopping</button> -->
                    <a href="{{ URL ('stripe',$wcp_price )}}" class="btn btn-lg btn-info mt-2">Via card</a>
                    <a href="{{ URL ('cash_order')}}" class="btn btn-lg btn-primary mt-2">Cash on delivery</a>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>