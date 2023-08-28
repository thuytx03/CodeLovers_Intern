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
            <div class="form-group">
                <label for="my-input">Tên vai trò</label>
                <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập tên vai trò" value="{{ $roles->name }}">
            </div>

            <div class="form-group mt-3">
                @csrf
                @method('PUT')
               <button type="submit" class="btn btn-primary">Cập nhật</button>
               <button type="reset" class="btn btn-danger">Nhập lại</button>
                <a href="{{ route('list.role') }}" class="btn btn-success">Danh sách</a>
            </div>
        </form>

@endsection
