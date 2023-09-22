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

    <form action="{{ route('saveAdd.user') }}" method="post">
        <div class="form-group mt-2">
            <label for="my-input">Họ và tên</label>
            <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập họ và tên"
                value="{{ old('name') }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Email</label>
            <input id="my-input" class="form-control" type="email" name="email" placeholder="Vui lòng nhập email"
                value="{{ old('email') }}">
        </div>

        <div class="form-group mt-2">
            <label for="roles">Vai trò</label>
            <select name="roles[]" id="roles" class="form-select" multiple>
                <option value="" disabled selected>Vui lòng chọn</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                @endforeach
            </select>
        </div>





        <div class="form-group mt-2">
            <label for="my-input">Số điện thoại</label>
            <input id="my-input" class="form-control" type="text" name="phone"
                placeholder="Vui lòng nhập số điện thoại" value="{{ old('phone') }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Địa chỉ</label>
            <input id="my-input" class="form-control" type="text" name="address" placeholder="Vui lòng nhập số địa chỉ"
                value="{{ old('address') }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Giới tính</label>
            <input id="my-input" class="form-check-input" type="radio" name="gender" value="1"> Nam
            <input id="my-input" class="form-check-input" type="radio" name="gender" value="2"> Nữ
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Mật khẩu</label>
            <input id="my-input" class="form-control" type="password" name="password" placeholder="Vui lòng nhập mật khẩu">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Nhập lại mật khẩu</label>
            <input id="my-input" class="form-control" type="password" name="enter_password"
                placeholder="Vui lòng nhập lại mật khẩu">
        </div>

        <div class="form-group mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <button type="reset" class="btn btn-danger">Nhập lại</button>
            <a href="{{ route('list.user') }}" class="btn btn-success">Danh sách</a>
        </div>
    </form>

@endsection
