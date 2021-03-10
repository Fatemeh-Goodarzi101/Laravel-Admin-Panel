@component('admin.layouts.content' , ['title' => 'گروه ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">گروه ها</li>
    @endslot
    
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">گروه ها</h3>

              <div class="card-tools d-flex">
                <form action="">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">
  
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
                <div class="btn-group-sm mr-2">
                  @can('create-role')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-info">ایجاد گروه جدید</a>
                  @endcan
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody><tr>
                  <th>نام گروه</th>
                  <th>توضیح گروه</th>
                  <th>اقدامات</th>
                </tr>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>{{$role->lable}}</td>
                        <td class="d-flex">
                            @can('delete-role')
                              <form action="{{ route('admin.roles.destroy' , $role->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="btn btn-sm btn-danger ml-1" type="submit">حذف</button>
                              </form>
                            @endcan

                            @can('edit-role')
                              <a href="{{ route('admin.roles.edit' , $role->id) }}" class="btn btn-sm btn-primary">ویرایش</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              {{ $roles->render() }}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
@endcomponent