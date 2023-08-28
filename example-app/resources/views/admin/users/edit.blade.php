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

    <form action="/admin/users/update/{{ $users->id }}" method="post">
        <div class="form-group mt-2">
            <label for="my-input">Họ và tên</label>
            <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập họ và tên"
                value="{{ $users->name }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Email</label>
            <input id="my-input" class="form-control" type="email" name="email" placeholder="Vui lòng nhập email"
                value="{{ $users->email }}">
        </div>

        <div class="form-group mt-2">
            <label for="my-input">Vai trò</label>
            <select name="role_id" class="form-select" id="">
                <option value="">Vui lòng chọn</option>
                @foreach ($roles as $value)
                    <option @if($value->id==$users->role_id) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="my-input">Số điện thoại</label>
            <input id="my-input" class="form-control" type="text" name="phone"
                placeholder="Vui lòng nhập số điện thoại" value="{{ $users->phone }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Địa chỉ</label>
            <input id="my-input" class="form-control" type="text" name="address" placeholder="Vui lòng nhập số địa chỉ"
                value="{{ $users->address }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Giới tính</label>
            <input id="my-input" class="form-check-input" type="radio" name="gender" value="1" {{ $users->gender==1 ? "checked" :"" }}> Nam
            <input id="my-input" class="form-check-input" type="radio" name="gender" value="2" {{ $users->gender==2 ? "checked" :"" }}> Nữ
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Mật khẩu</label>
            <input id="my-input" class="form-control" type="password" value="" name="password" placeholder="*************">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Nhập lại mật khẩu</label>
            <input id="my-input" class="form-control" type="password" value="" name="enter_password"
                placeholder="*************">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Trạng thái: </label>
            <input id="my-input" class="form-check-input" type="radio" name="status" value="1" {{ $users->status==1 ? "checked" : "" }}> Hoạt động
            <input id="my-input" class="form-check-input" type="radio" name="status" value="2"  {{ $users->status==2 ? "checked" : "" }}> Ngừng hoạt động
        </div>
        <div class="form-group mt-3">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <button type="reset" class="btn btn-danger">Nhập lại</button>
            <a href="{{ route('list.user') }}" class="btn btn-success">Danh sách</a>
        </div>
    </form>

@endsection
