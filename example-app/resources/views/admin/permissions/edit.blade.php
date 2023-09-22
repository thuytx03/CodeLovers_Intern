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

        <form action="/admin/permissions/update/{{ $permission->id }}" method="post">
            <div class="form-group mb-3">
                <label for="my-input">Tên</label>
                <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập tên quyền" value="{{ $permission->name }}">
            </div>
            <div class="form-group mb-3">
                <label for="my-input">Tên hiển thị</label>
                <input id="my-input" class="form-control" type="text" name="display_name" placeholder="Vui lòng nhập tên hiển thị" value="{{ $permission->display_name }}">
            </div>

            <div class="form-group mb-3">
                <label for="my-input">Nhóm</label>
                <input id="my-input" class="form-control" type="text" name="group" placeholder="Nhóm" value="{{ $permission->group }}">

            </div>

            <div class="form-group mt-3">
                @csrf
                @method('PUT')
               <button type="submit" class="btn btn-primary">Cập nhật</button>
               <button type="reset" class="btn btn-danger">Nhập lại</button>
                <a href="{{ route('list.permission') }}" class="btn btn-success">Danh sách</a>
            </div>
        </form>

@endsection
