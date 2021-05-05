@foreach ($categories as $category)
    <div class="container-fluid">
        <div style="padding-top: 20px">
            <h4 style="display:inline-block;padding-left: 10px">{{ $category->name }}</h4>
            <button><a href="{{ route('category' , $category->id) }}"><span style="display:inline-block">مشاهده بیشتر</span></a></button>
        </div>
        <div class="scrolling-wrapper row mt-4 pb-4 pt-2">
            @foreach ($category->products->take(4) as $product)
            <div class="col-3" style="padding: 5px 25px 25px">
                <div class="card card-block">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                    </div>
                    <div class="card-body">
                        <button style="float: left;"><a href="{{route('product.single', $product->id)}}" class="card-link">جزئیات محصول</a></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endforeach
