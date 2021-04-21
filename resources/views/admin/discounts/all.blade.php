@component('admin.layouts.content' , ['title' => 'لیست تخفیفات'])
     @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">لیست تخفیف ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">تخفیف ها</h3>

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
                  {{-- @can('create-discount') --}}
                    <a href="{{ route('admin.discounts.create') }}" class="btn btn-info">ایجاد تخفیف جدید</a>  
                  {{-- @endcan --}}
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody><tr>
                  <th>آیدی تخفیف</th>
                  <th>کد تخفیف</th>
                  <th>میزان درصدی تخفیف</th>
                  <th>مربوط به کاربر</th>
                  <th>مربوط به محصول</th>
                  <th>مربوط به دسته بندی</th>
                  <th>مهلت استفاده</th>
                  <th>اقدامات</th>
                </tr>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $discount->id }}</td>
                        <td>{{ $discount->code }}</td>
                        <td>{{ $discount->percent }}</td>
                        <td>{{ $discount->users->count() ? $discount->users->pluck('name')->join(', ') : 'همه کاربران' }}</td>
                        <td>{{ $discount->products->count() ? $discount->products->pluck('title')->join(', ') : 'همه محصولات' }}</td>
                        <td>{{ $discount->categories->count() ? $discount->categories->pluck('name')->join(', ') : 'همه دسته ها' }}</td>
                        <td>{{ jdate($discount->expired_at)->ago() }}</td>
                        <td class="d-flex">
                            {{-- @can('delete-discount') --}}
                              <form action="{{ route('admin.discounts.destroy' , $discount->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="btn btn-sm btn-danger ml-1" type="submit">حذف</button>
                              </form>
                            {{-- @endcan --}}

                            {{-- @can('edit-discount') --}}
                              <a href="{{ route('admin.discounts.edit' , $discount->id) }}" class="btn btn-sm btn-primary ml-2">ویرایش</a>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              {{ $discounts->appends([ 'search' => request('search') ])->render() }}
            </div>
          </div>
          <!-- /.card -->
        </div>
    </div>
@endcomponent