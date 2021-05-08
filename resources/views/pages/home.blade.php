@extends('layouts.app')

@section('content')

    @include('home.categories' , $categories)

    <img src="img\b.jpg" class="banner-img" alt="banner" style="border-radius: 8px ; height: 400px !important;">

@endsection
