@extends('layouts.app')

@section('content')

    {{-- baner image --}}
    <div>
        <img src="/img/banner.jpg" class="banner-img" alt="banner">
        <div class="banner-text">
          <h2 style="font-size:50px">Online Shop</h2>
          <p>Have a Nice Shopping</p>
        </div>
    </div>
    @include('home.categories' , $categories)
    
@endsection
