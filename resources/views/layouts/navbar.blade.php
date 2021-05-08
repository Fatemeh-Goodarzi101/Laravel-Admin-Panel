@php
    $categories = App\Models\Category::all();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i class="fas fa-home"></i>صفحه اصلی</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                دسته بندی محصولات
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              @foreach ($categories as $category)
                <a style="text-align:right" class="dropdown-item" href="{{ route('category' , $category->id) }}">{{ $category->name }}</a>
              @endforeach
            </div>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="دنبال چی هستی؟" aria-label="Search">
          <button class="btn" type="submit">جستجو</button>
        </form>
      </div>
    </div>
  </nav>
