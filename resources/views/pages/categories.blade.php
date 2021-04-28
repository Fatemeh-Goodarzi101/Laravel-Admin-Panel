@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mt-5">{{ $category->name ?? 'محصولات'  }}</h4> 
    <div class="scrolling-wrapper row mt-4 pb-4 pt-2">
		@foreach ($products as $product)
        <div class="col-3" style="padding: 5px 25px 25px">
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
