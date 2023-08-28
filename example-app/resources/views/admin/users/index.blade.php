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
    <form action="{{ route('deleteAll.user') }}" method="post" id="delete-form">
        @csrf
        <div class="d-flex justify-content-end mt-3 mb-3">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hành động
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('add.user') }}">Thêm mới</a></li>
                    <li><a class="dropdown-item" href="{{ route('trash.user') }}">Thùng rác</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>
                </ul>
            </div>
        </div>

        <table class="table table-striped table-hover text-center table-responsive-md">
            <thead>
                <tr>
                    <td>
                        <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                    </td>
                    <th>Tên </th>
                    <th>Email</th>
                    <th>Hình ảnh </th>
                    <th>Vai trò</th>
                    <th>Số điện thoại</th>

                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $item)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input" name="ids[{{ $item->id }}]"
                                value="{{ $item->id }}">
                        </td>
                        <td>{{ $item->name ?? 'Trống' }}</td>
                        <td>{{ $item->email ?? 'Trống' }}</td>
                        <td><img src="{{ $item->avatar }}" width="30" alt=""></td>
                        <td>{{ $item->role->name ?? 'Trống' }}</td>
                        <td>{{ $item->phone ?? 'Trống' }}</td>

                        <td>
                            <?php $user = '/admin/users/destroy/'; ?>
                            <a href="/admin/users/destroy/{{ $item->id }}"
                                onclick="event.preventDefault(); showDeleteConfirm('{{ $item->id }}','{{ $user }}');"
                                class="btn btn-danger mt-1"><i class='bx bx-trash'></i></a>
                            <a href="/admin/users/edit/{{ $item->id }}" class="btn btn-primary mt-1"><i
                                    class='bx bx-edit'></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $users->links() }}
    </form>


@endsection
