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

        <form action="/admin/roles/update/{{ $roles->id }}" method="post">
            <div class="form-group mb-3">
                <label for="my-input">Tên</label>
                <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập tên vai trò" value="{{ $roles->name }}">
            </div>
            <div class="form-group mb-3">
                <label for="my-input">Tên hiển thị</label>
                <input id="my-input" class="form-control" type="text" name="display_name" placeholder="Vui lòng nhập tên hiển thị" value="{{ $roles->display_name }}">
            </div>
            <div class="form-group mb-3">
                <label for="my-input">Nhóm</label>
                <select name="group" class=form-select id="" >
                    <option  value="">Vui lòng chọn</option>
                    <option {{ $roles->group=='system' ? 'selected' :'' }}  value="system">Hệ thống</option>
                    <option {{ $roles->group=='user' ? 'selected' :'' }}  value="user">Người dùng</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="mb-2">Permission</label>
                <input type="checkbox" name="" class="form-check-input" id="select_alls">
                <div class="row">
                    @foreach ($permission as $groupName => $permission)
                        <div class="col-5">
                            <strong>{{ $groupName }}</strong>

                            <div>
                                @foreach ($permission as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" name="permission[]" type="checkbox"
                                            value="{{ $item->id }}" {{ in_array($item->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="customCheck1">{{ $item->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#select_alls').click(function() {
                        // Get the state of the select all checkbox
                        var isChecked = $(this).prop('checked');

                        // Set the state of all other checkboxes
                        $('.form-check-input').prop('checked', isChecked);
                    });
                });
                </script>
            <div class="form-group mt-3">
                @csrf
                @method('PUT')
               <button type="submit" class="btn btn-primary">Cập nhật</button>
               <button type="reset" class="btn btn-danger">Nhập lại</button>
                <a href="{{ route('list.role') }}" class="btn btn-success">Danh sách</a>
            </div>
        </form>

@endsection
