@component('admin.layouts.content' , ['title' => 'ویرایش دسته بندی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">لیست دسته بندی ها</a></li>
        <li class="breadcrumb-item active">ویرایش دسته بندی</li>
    @endslot

   <div class="row">
       <div class="col-lg-12">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">فرم ویرایش دسته بندی</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('admin.categories.update' , $category->id) }}">
              @csrf
              @method('PATCH')

              <div class="card-body">
                <div class="form-group col-sm-10">
                    <label for="name" class="col-sm-2 control-label">نام دسته بندی</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="نام دسته بندی را وارد کنید" value="{{ old('name' , $category->name) }}">
                </div>
              </div>
              <div class="form-group">
                <label for="lable" class="col-sm-2 control-label">دسته بندی والد</label>
                <select class="form-control" name="parent" id="permissions">
                  @foreach (App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id === $category->parent ? 'selected' : '' }}>{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">ویرایش دسته بندی</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default float-left">لغو</a>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
       </div>
   </div>

@endcomponent