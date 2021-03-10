@component('admin.layouts.content' , ['title' => 'ویرایش گروه'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">همه گروه ها</a></li>
        <li class="breadcrumb-item active">ویرایش گروه</li>
    @endslot

    @slot('script')
        <script>
          $('#permissions').select2({
            'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
           })
        </script>
    @endslot

   <div class="row">
       <div class="col-lg-12">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">فرم ویرایش گروه</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('admin.roles.update' , $role->id) }}">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="form-group col-sm-10">
                    <label for="name" class="col-sm-2 control-label">عنوان گروه</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="عنوان گروه را وارد کنید" value="{{ old('name' , $role->name) }}">
                </div>
                <div class="form-group col-sm-10">
                  <label for="lable" class="col-sm-2 control-label">توضیح گروه</label>
                  <input type="text" name="lable" class="form-control" id="lable" placeholder="توضیح گروه را وارد کنید" value="{{ old('lable' , $role->lable) }}">
                </div>
                <div class="form-group">
                  <label for="lable" class="col-sm-2 control-label">دسترسی ها</label>
                  <select class="form-control" name="permissions[]" id="permissions" multiple>
                    @foreach (App\Models\Permission::all() as $permission)
                      <option value="{{ $permission->id }}" {{ in_array($permission->id , $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->name }} - {{ $permission->lable }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">ویرایش گروه</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default float-left">لغو</a>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
       </div>
   </div>

@endcomponent