@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills" style="padding: 0">
                        <li class="nav-item" style="padding-left: 5px">
                            <button><a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">پروفایل</a></button>
                        </li>
                        <li class="nav-item" style="padding-left: 5px">
                            <button><a class="nav-link {{ request()->is('profile/twofactor') ? 'active' : '' }}" href="{{ route('profile.2fa.manage') }}">احراز هویت دو مرحله ای</a></button>
                        </li>
                        <li class="nav-item" style="padding-left: 5px">
                            <button><a class="nav-link {{ request()->is('profile/orders') ? 'active' : '' }}" href="{{ route('profile.orders') }}">سفارشات</a></button>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection