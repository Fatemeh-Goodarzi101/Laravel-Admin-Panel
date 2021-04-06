<ul class="list-group list-group-flush">
    @foreach ($categories as $cat)
        <li class="list-group-item">
            <div class="d-flex">
                <span>{{ $cat->name }}</span>
                <div class="actions mr-2">
                    <form action="{{ route('admin.categories.destroy' , $cat->id) }}" id="cat-{{ $cat->id }}-delete" method="POST">
                        @csrf
                        @method('delete')
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('cat-{{ $cat->id }}-delete').submit()" class="badge badge-danger">حذف</a>
                    <a href="{{ route('admin.categories.edit' , $cat->id) }}" class="badge badge-primary">ویرایش</a>
                    <a href="{{ route('admin.categories.create') }}?parent={{ $cat->id }}" class="badge badge-warning">ثبت زیر دسته</a>
                </div>
            </div>
            @if($cat->child->count())
                @include('admin.layouts.categories-group' , ['categories' => $cat->child])
            @endif
        </li>
    @endforeach
</ul>