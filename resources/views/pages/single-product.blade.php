@extends('layouts.app')

@section('script')
    <script>
        $('#sendComment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            let parent_id = button.data('id');

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('input[name="parent_id"]').val(parent_id)
        })

        document.querySelector('#sendCommentForm').addEventListener('submit' , function(event) {
            event.preventDefault();
            let target = event.target;
            let data = {
                commentable_id : target.querySelector('input[name="commentable_id"]').value,
                commentable_type : target.querySelector('input[name="commentable_type"]').value,
                parent_id : target.querySelector('input[name="parent_id"]').value,
                comment : target.querySelector('textarea[name="comment"]').value,
            }

            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type' : 'application/json'
                }
            })

            $.ajax({
                type : 'POST',
                url : '/comments',
                data : JSON.stringify(data),
                success : function(data) {
                }
            })
        
        })
    </script>
@endsection

@section('content')

    @auth
        <div class="modal fade" id="sendComment">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ارسال نظر</h5>
                        <button type="button" class="close mr-auto ml-0" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('send.comment') }}" method="POST" id="sendCommentForm">
                        @csrf
                        <div class="modal-body">
                                <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                                <input type="hidden" name="commentable_type" value="{{ get_class($product) }}">
                                <input type="hidden" name="parent_id" value="0">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">پیام دیدگاه:</label>
                                    <textarea name="comment" class="form-control" id="message-text"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                            <button type="submit" class="btn btn-primary">ارسال نظر</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth

    <div class="content-header">
        <div class="row mr-2 ml-2" style="background-color:rgba(238, 203, 247, 0.973); border-radius: 3px">
            <div class="col-lg-12">
                <ul class="breadcrumb float-sm-right" style="margin: 0 ; background-color:rgba(238, 203, 247, 0.973);">
                    <li class="breadcrumb-item"><a href="/home">صفحه اصلی</a></li>
                    <li class="breadcrumb-item active">محصولات</li>
                    <li class="breadcrumb-item active">{{ $product->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}" style="width: 100%; height: 100%">
                      </div>
                      <div class="col-md-8">
                        <div class="card-header d-flex justify-content-between">
                            {{ $product->title }}
                            @if (Cart::count($product) < $product->inventory)
                                <form action="{{ route('cart.add' , $product->id) }}" method="post" id="add-to-cart">
                                    @csrf
                                </form>
                                <button><a onclick="document.getElementById('add-to-cart').submit()" class="btn btn-sm btn-danger">افزودن به سبد خرید</a></button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if ($product->categories)
                                دسته بندی محصول : 
                                @foreach ($product->categories as $cat)
                                    <a href="#">{{ $cat->name }}</a>
                                @endforeach
                            @endif
                            <hr>
                            <div class="card-title">
                                درباره محصول 
                            </div>
                            <p class="card-text">توضیح فروشنده : {{ $product->description }} </p>
                            <p class="card-text">قیمت : {{ $product->price }} هزار تومان</p>
                            <p class="card-text">موجودی در انبار : {{ $product->inventory }} </p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br><hr>

        <div class="row">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="mt-4">بخش نظرات</h4>
                    @auth
                        <button><a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#sendComment" data-id="0">ثبت نظر جدید</a></button>
                    @endauth
                </div>
 
                @guest
                    <div class="alert alert-warning">
                        برای ثبت نظر لطفا وارد سایت شوید.
                    </div>
                @endguest
               @include('layouts.comments' , ['comments' => $product->comments()->where('parent_id' , 0)->get()])
            </div>
        </div>

        <br><br><br><br><hr>

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h3 class="mb-6">محصولات مشابه</h3>
                </div>
                <div class="col-12">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                  @foreach ($relatedProducts->take(3) as $relProduct)
                                    <div class="col-md-4 mb-3">
                                      <div class="card" style="width: 350px; height: 400px;">
                                          <img class="img-fluid" style="height: 75%" alt="{{ $relProduct->title }}" src="{{ $relProduct->image }}">
                                          <div class="card-body">
                                              <h4 class="card-title">{{ $relProduct->title }}</h4>
                                              <button style="float: left;"><a href="{{route('product.single' , $relProduct->id)}}" class="card-link">جزئیات محصول</a></button>
                                          </div>
                                      </div>
                                    </div>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
