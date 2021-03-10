@component('admin.layouts.content' , ['title' => 'ثبت دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ثبت دسترسی</li>
    @endslot
    
    @slot('script')
        <script>
          $('#roles').select2({ 
            'placeholder' : 'گروه مورد نظر را انتخاب کنید'
          })
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
              <h3 class="card-title">فرم ثبت دسترسی</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('admin.users.permissions.store' , $user->id) }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="lable" class="col-sm-2 control-label">گروه ها</label>
                  <select class="form-control" name="roles[]" id="roles" multiple>
                    @foreach (App\Models\Role::all() as $role)
                      <option value="{{ $role->id }}" {{ in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->name }} - {{ $role->lable }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="lable" class="col-sm-2 control-label">دسترسی ها</label>
                  <select class="form-control" name="permissions[]" id="permissions" multiple>
                    @foreach (App\Models\Permission::all() as $permission)
                      <option value="{{ $permission->id }}" {{ in_array($permission->id , $user->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->name }} - {{ $permission->lable }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">ثبت دسترسی</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-default float-left">لغو</a>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
       </div>
   </div>

@endcomponent