<?php
use Carbon\Carbon;
?>

<div class="comments-container">


    <div class="d-flex flex-column ml-3">


        <div class="coment-bottom bg-white p-2 px-4">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $value)
                <p class="text-center">{{ $value }}</p>
            </div>
            @endforeach
            @endif
            @if($message=session('message'))
            <div class="alert alert-success">
                <p class="text-center">{{$message}}</p>
            </div>
            @endif

            <form action="{{URL('add_product_comment',$product->id)}}" method="POST">
                <input type="text" name="comment" class="form-control mr-3" placeholder="Add review">
                <button type="submit" class="btn btn-primary">Submit</button>
                @csrf
            </form>

        </div>
        @foreach($comments as $value)
        <ul id="comments-list" class="comments-list">
            <li>
                <div class="comment-main-level">
                    <!-- Avatar -->
                    <div class="comment-avatar"><img
                            src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt="">
                    </div>
                    <!-- Contenedor del Comentario -->

                    <div class="comment-box">
                        <div class="comment-head">
                            <h6 class="comment-name by-author"><a href="http://creaticode.com/blog">{{$value->name}}</a>
                            </h6>
                            <?php $timeAgo = Carbon::parse($value->created_at)->ago();?>
                            <span class="mb-1 ml-2"><?php echo $timeAgo; ?>
                            </span>

                            <i class="fa fa-reply">
                                <p><a data-token="{{ csrf_token() }}" data-comment-id="{{ $value->id }}"
                                        class="wcp-comment-reply">Reply</a></p>
                            </i>
                            <i class="fa fa-heart"></i>
                        </div>
                        <div class="comment-content">
                            {{$value->comment}}
                        </div>
                    </div>

                </div>
                <!-- Respuestas de los comentarios -->
                <ul class="comments-list reply-list">
                    @foreach($value->getReplies as $value2)
                    <li>
                        <!-- Avatar -->
                        <div class="comment-avatar"><img
                                src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt="">
                        </div>
                        <!-- Contenedor del Comentario -->

                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name"><a href="http://creaticode.com/blog">{{$value2->name}}</a>
                                </h6>
                                <?php $timeAgo = Carbon::parse($value->created_at)->ago();?>
                                <span class="mb-1 ml-2"><?php echo $timeAgo; ?>
                                </span>

                                <i class="fa fa-reply">
                                    <p><a data-token="{{ csrf_token() }}" data-comment-id="{{ $value->id }}"
                                            class="wcp-comment-reply">Reply</a></p>
                                </i>
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="comment-content">
                                {{$value2->reply}}
                            </div>



                            @endforeach
                        </div>
                    </li>


                </ul>
                @endforeach
    </div>
    <div class="pagination"
        style="margin-top:45px;padding-top:20px;text-align:center;display:flex;justify-content:center;align-items:center">
        {{ $comments->links('pagination::bootstrap-4') }}
    </div>

    </body>

    </html>