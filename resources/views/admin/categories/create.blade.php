@component('admin.layouts.content' , ['title' => 'ایجاد دسته بندی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">لیست دسته بندی ها</a></li>
        <li class="breadcrumb-item active">ایجاد دسته بندی</li>
    @endslot

   <div class="row">
       <div class="col-lg-12">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">فرم ایجاد دسته بندی</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('admin.categories.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group col-sm-10">
                    <label for="name" class="col-sm-2 control-label">نام دسته بندی</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="نام دسته بندی را وارد کنید">
                </div>
                @if(request('parent'))
                  @php
                    $parent = \App\Models\Category::find(request('parent'))    
                  @endphp
                  <div class="form-group col-sm-10">
                    <label for="name" class="col-sm-2 control-label"> نام دسته بندی والد</label>
                    <input type="text" class="form-control" id="name" disabled value="{{ $parent->name }}">
                    <input type="hidden" name="parent" value="{{ $parent->id }}">
                  </div>
                @endif
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">ثبت دسته بندی</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default float-left">لغو</a>
              </div>

              <!-- /.card-footer -->
            </form>
          </div>
       </div>
   </div>

@endcomponent