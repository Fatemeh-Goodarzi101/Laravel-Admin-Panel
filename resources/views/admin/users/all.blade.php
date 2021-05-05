@component('admin.layouts.content' , ['title' => 'لیست کاربران'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">لیست کاربران</li>
    @endslot
    
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">کاربران</h3>

              <div class="card-tools d-flex">
                <form action="">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">
  
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
                <div class="btn-group btn-group-sm mr-2">
                  @can('create-user')
                    <button style="margin-left: 4px;"><a href="{{ route('admin.users.create') }}">ایجاد کاربر جدید</a></button>
                  @endcan
                  @can('show-staff-users')
                    <button><a href="{{ request()->fullUrlWithQuery(['admin' => 1]) }}">کاربران مدیر</a></button>
                  @endcan
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody><tr>
                  <th>آیدی کاربر</th>
                  <th>نام کاربر</th>
                  <th>ایمیل</th>
                  <th>وضعیت ایمیل</th>
                  <th>اقدامات</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if ($user->email_verified_at)
                            <td><span class="badge badge-success">فعال</span></td>
                        @else
                            <td><span class="badge badge-danger">غیر فعال</span></td>
                        @endif
                        <td class="d-flex">
                            @can('delete-user')
                              <form action="{{ route('admin.users.destroy' , ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="btn btn-sm btn-danger ml-1" type="submit">حذف</button>
                              </form>
                            @endcan

                            @can('edit-user')
                              <a href="{{ route('admin.users.edit' , ['user' => $user->id]) }}" class="btn btn-sm btn-primary ml-2">ویرایش</a>
                            @endcan
                            
                            @if ($user->isStaffUser())
                              @can('staff-user-permissions')
                                <a href="{{ route('admin.users.permissions' , $user->id) }}" class="btn btn-sm btn-warning">دسترسی</a>
                              @endcan
                            @endif

                        </td>
                    </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              {{ $users->appends([ 'search' => request('search') ])->render() }}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
@endcomponent