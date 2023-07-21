<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>

        <div class="row">
            @foreach($products as $value)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            @if ($value->title != null)
                            <a href="{{url('product_details',$value->id)}}" class="option1">

                                Product Details
                            </a>
                            @endif
                            <a href="" class="option2">
                                Buy Now
                            </a>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="<?php echo url('images/' . $value->image); ?>">
                        <!-- <img src="home/images/p1.png" alt=""> -->
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$value->description}}
                        </h5>
                        <h6>₹
                            {{$value->price}}
                        </h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination"
            style="margin-top:45px;padding-top:20px;text-align:center;display:flex;justify-content:center;align-items:center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>

    </div>
</section>