@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="row mr-2 ml-2" style="background-color:rgba(238, 203, 247, 0.973); border-radius: 3px">
        <div class="col-lg-12">
            <ul class="breadcrumb float-sm-right" style="margin: 0 ; background-color:rgba(238, 203, 247, 0.973);">
                <li class="breadcrumb-item"><a href="/home">صفحه اصلی</a></li>
                <li class="breadcrumb-item active">دسته بندی ها</li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid mt-1">
    <div class="col-lg-4 float-right">
        <div class="card rounded">
            <div class="card-body">
                <h6 class="card-title mb-2">جستجو</h6>
                <div class="m-0 p-0 border-top border-grey">
                    <form class="mt-2">
                        <input type="text" class="form-control" placeholder="جستجو کنید">
                        <button class="btn btn-outline-warning btn-block mt-2" type="submit">جستجو کنید</button>
                    </form>
                </div>
            </div><!--end blog post-->
        </div>
        <div class="card rounded mt-3">
            <div class="card-body">
                <h6 class="card-title mb-2">دسته بندی ها</h6>
                <ul class="list-group m-0 p-0 pt-2 border-top border-grey">
                    @foreach ($categories as $cat)
                        <div class="form-check">
                            <input @if($category->id == $cat->id) checked @endif class="form-check-input" type="checkbox" value="{{ $cat->id }}" id="{{ $cat->id }}" />
                            <label class="form-check-label" for="{{ $cat->id }}">{{ $cat->name }}</label>
                        </div>
                    @endforeach
                </ul>
            </div><!--end blog post-->
        </div>
    </div>
    <div class="col-lg-8 float-left">
        @foreach ($products as $product)
            <div class="col-lg-4 float-left" style="padding: 5px 25px 25px">
                <div class="card card-block">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                    </div>
                    <div class="card-body">
                        <button style="float: left;"><a href="{{route('product.single' , $product->id)}}" class="card-link">جزئیات محصول</a></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
