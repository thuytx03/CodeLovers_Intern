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

    <form action="{{ route('saveAdd.types') }}" method="post" enctype="multipart/form-data">
        <div class="form-group mt-2">
            <label for="my-input">Tên danh mục</label>
            <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập tên danh mục"
                value="{{ old('name') }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Tên đường dẫn</label>
            <input id="my-input" class="form-control" type="text" name="slug"
                placeholder="Vui lòng nhập tên đường dẫn" value="{{ old('slug') }}">
        </div>
        <div class="form-group mt-2">
            <label for="my-input">Danh mục cha</label>
            <select name="parent_id" id="" class="form-select">
                <option value="0">Vui lòng chọn</option>

                @foreach ($data as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="image">Hình ảnh</label> <br>
            <input id="image" class="form-control" type="file" name="image" hidden>
            <label for="image">
                <img src="https://png.pngtree.com/element_our/20190528/ourmid/pngtree-flat-plus-image_1127818.jpg"
                    width="100" id="preview-image" class="mt-1" alt="">

            </label>

        </div>

        <div class="form-group mt-2">
            <label for="my-input">Mô tả</label>
            <textarea name="description" class="form-control" id="" cols="10" rows="5"></textarea>
        </div>

        <div class="form-group mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <button type="reset" class="btn btn-danger">Nhập lại</button>
            <a href="{{ route('list.types') }}" class="btn btn-success">Danh sách</a>
        </div>
    </form>

@endsection
