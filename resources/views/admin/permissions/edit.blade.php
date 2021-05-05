@component('admin.layouts.content' , ['title' => 'ویرایش دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">لیست دسترسی ها</a></li>
        <li class="breadcrumb-item active">ویرایش دسترسی</li>
    @endslot

   <div class="row">
       <div class="col-lg-12">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">فرم ویرایش دسترسی</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('admin.permissions.update' , $permission->id) }}">
              @csrf
              @method('PATCH')

              <div class="card-body">
                <div class="form-group col-sm-10">
                    <label for="name" class="col-sm-2 control-label">عنوان دسترسی</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="عنوان دسترسی را وارد کنید" value="{{ old('name' , $permission->name) }}">
                </div>
                <div class="form-group col-sm-10">
                  <label for="lable" class="col-sm-2 control-label">توضیح دسترسی</label>
                  <input type="text" name="lable" class="form-control" id="lable" placeholder="توضیح دسترسی را وارد کنید" value="{{ old('lable' , $permission->lable) }}">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">ویرایش دسترسی</button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-default float-left">لغو</a>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
       </div>
   </div>

@endcomponent