@extends('profile.layout')

@section('main')
    <h4> احراز هویت دو مرحله ای: </h4>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="#" method="POST">
        @csrf

        <div class="form-group">
            <label for="type">نوع احراز هویت</label>
            <select name="type" id="type" class="form-control">
                @foreach (config('twofactor.types') as $key => $name)
                    <option value="{{ $key }}" {{ old('type') == $key || auth()->user()->hasTwoFactor($key) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="phone">شماره تلفن</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="لطفا شماره تماس خود را وارد کنید..." value="{{ old('phone') ?? auth()->user()->phone_number }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">
                ارسال
            </button>
        </div>
    </form>
@endsection