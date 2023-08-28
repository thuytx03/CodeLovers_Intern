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
    <form action="{{ route('deleteAll.categories') }}" method="post" id="delete-form">
        @csrf
    <div class="d-flex justify-content-end mt-3 mb-3">
        <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hành động
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('add.categories') }}">Thêm mới</a></li>
                <li><a class="dropdown-item" href="{{ route('trash.categories') }}">Thùng rác</a></li>
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
                <th>Tên vai trò</th>
                <th>Tên đường dẫn</th>
                <th>Quan hệ</th>
                <th>
                    Hành động

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data1->where('parent_id', 0) as $parentItem)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input" name="ids[{{ $parentItem->id }}]"
                            value="{{ $parentItem->id }}">
                    </td>
                    <td>{{ $parentItem->name }}</td>
                    <td>{{ $parentItem->slug }}</td>
                    <td>Cha</td>
                    <td>
                        <?php $category='/admin/categories/destroy/'; ?>

                        <a href="/admin/categories/destroy/{{ $parentItem->id }}" onclick="event.preventDefault(); showDeleteConfirm('{{ $parentItem->id }}','{{ $category }}');" class="btn btn-danger"><i
                                class='bx bx-trash'></i></a>
                        <a href="/admin/categories/edit/{{ $parentItem->id }}" class="btn btn-primary"><i
                                class='bx bx-edit'></i></a>

                    </td>
                </tr>
                @foreach ($data1->where('parent_id', $parentItem->id) as $childItem)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[{{ $childItem->id }}]" value="{{ $childItem->id }}"
                                class="form-check-input" id="">
                        </td>
                        <td>---{{ $childItem->name }}</td>
                        <td>{{ $childItem->slug }}</td>
                        <td>Con</td>
                        <td>
                            <a href="/admin/categories/destroy/{{ $childItem->id }}" onclick="event.preventDefault(); showDeleteConfirm('{{ $childItem->id }}','{{ $category }}');" class="btn btn-danger"><i
                                    class='bx bx-trash'></i></a>
                            <a href="/admin/categories/edit/{{ $childItem->id }}" class="btn btn-primary"><i
                                    class='bx bx-edit'></i></a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    </form>
    {{ $data1->links() }}

@endsection
