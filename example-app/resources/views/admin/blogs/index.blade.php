@extends('admin.layouts.main')
@section('content')
    <h1>{{ $title }}</h1>
    @if (session('success'))
        <div class="alert alert-primary">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('deleteAll.blogs') }}" method="post" id="delete-form">
        @csrf
    <div class="d-flex justify-content-end mt-3 mb-3">
        <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hành động
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('add.blogs') }}">Thêm mới</a></li>
                <li><a class="dropdown-item" href="{{ route('trash.blogs') }}">Thùng rác</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);"
                    onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>
            </ul>
        </div>
    </div>

    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <td>
                    <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                </td>
                <th>Tên bài viết</th>
                <th>Hình ảnh</th>
                <th>Tên đường dẫn</th>
                <th>Tác giả</th>
                <th>Trạng thái</th>
                <th>
                    Hành động

                </th>
            </tr>
        </thead>
        <tbody>
           @foreach($data as $value)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input" name="ids[{{ $value->id }}]"
                            value="{{ $value->id }}">
                    </td>
                    <td>{{ $value->name }}</td>
                    <td><img src="{{ Storage::url($value->cover_image) }}" width="50" alt=""></td>
                    <td>{{ $value->slug }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->status == 1 ? "Công khai" : "Không công khai" }}</td>
                    <td>
                        <?php $blogUrl='/admin/blogs/destroy/'; ?>

                        <a href="/admin/blogs/destroy/{{ $value->id }}" onclick="event.preventDefault(); showDeleteConfirm('{{ $value->id }}','{{ $blogUrl }}');" class="btn btn-danger"><i
                                class='bx bx-trash'></i></a>
                        <a href="/admin/blogs/edit/{{ $value->id }}" class="btn btn-primary"><i
                                class='bx bx-edit'></i></a>
                    </td>
                </tr>
           @endforeach
        </tbody>
    </table>
    </form>
    {{ $data->links() }}

@endsection
