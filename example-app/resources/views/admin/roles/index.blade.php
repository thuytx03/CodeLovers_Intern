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
    <form action="{{ route('deleteAll.role') }}" method="post" id="delete-form">

        <div class="d-flex justify-content-end mt-3 mb-3">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hành động
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('add.role') }}">Thêm mới</a></li>
                    <li><a class="dropdown-item" href="{{ route('trash.role') }}">Thùng rác</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>

                </ul>
            </div>
        </div>
        @csrf
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <td>
                        <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                    </td>
                    <th>Tên vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key => $item)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input" name="ids[{{ $item->id }}]"
                                value="{{ $item->id }}">
                        </td>
                        <td>{{ $item->name }}</td>

                        <td>
                            <?php $role='/admin/roles/destroy/'; ?>
                            <a href="/admin/roles/destroy/{{ $item->id }}" onclick="event.preventDefault(); showDeleteConfirm('{{ $item->id }}','{{ $role }}');" class="btn btn-danger mt-1"><i
                                    class='bx bx-trash'></i></a>

                            <a href="/admin/roles/edit/{{ $item->id }}" class="btn btn-primary"><i
                                class='bx bx-edit'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    {{ $roles->links() }}

@endsection
