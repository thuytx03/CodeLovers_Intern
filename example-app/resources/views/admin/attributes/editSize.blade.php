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

        <form action="{{ route('editSize.attributes',['id'=>$size->id]) }}" method="post">
            <div class="form-group">
                <label for="my-input">Tên kích thước</label>
                <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập tên kích thước" value="{{ $size->name }}">
            </div>

            <div class="form-group mt-3">
                @csrf
               <button type="submit" class="btn btn-primary">Cập nhật</button>
               <button type="reset" class="btn btn-danger">Nhập lại</button>
                <a href="{{ route('listSize.attributes') }}" class="btn btn-success">Danh sách</a>
            </div>
        </form>

@endsection
