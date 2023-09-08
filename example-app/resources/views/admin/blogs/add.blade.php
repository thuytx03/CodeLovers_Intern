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

    <form action="{{ route('saveAdd.blogs') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="my-input">Tiêu đề</label>
            <input id="my-input" class="form-control" type="text" name="name" placeholder="Vui lòng nhập tên danh mục"
                value="{{ old('name') }}">
        </div>
        <div class="form-group mt-3">
            <label for="my-input">Tên dường dẫn</label>
            <input id="my-input" class="form-control" type="text" name="slug" placeholder="Vui lòng nhập tên đường dẫn"
                value="{{ old('slug') }}">
        </div>
        <div class="form-group mt-3">
            <label for="my-input">Ảnh bìa</label>
            <input type="file" name="cover_image" id="image" class="form-control">
            <img id="preview-image" class="mt-3 " src="#" alt="Ảnh sản phẩm"
                style="max-width: 200px; border-radius:5px; height:150px">
        </div>
        <div class="form-group mt-3">
            <label for="my-input">Danh mục tin tức</label>
            <div class="col-md-12 col-sm-12">
                <div class="card overflow-hidden mb-4" style="height: auto; overflow-y: auto;">
                    {{-- <h5 class="card-header">Danh mục </h5> --}}
                    <div class="card-body ps ps--active-y" id="vertical-example">
                        @foreach ($data->where('parent_id',0) as $item)
                            <div class="form-check">
                                <input class="form-check-input" name="type_id[]" type="checkbox" value=" {{ $item->id }}"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $item->name }}
                                </label>
                            </div>
                            @foreach($data->where('parent_id',$item->id) as $children)
                            <div class="form-check">
                                <input class="form-check-input" name="type_id[]" type="checkbox" value=" {{ $children->id }}"
                                    id="flexCheckDefault" style="margin-left:5px;">
                                <label class="form-check-label" style="margin-left:5px;" for="flexCheckDefault">
                                    {{ $children->name }}
                                </label>
                            </div>
                            @endforeach
                        @endforeach
                        <div class="ps__rail-x" style="left: 0px; bottom: -1090px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 1090px; height: 232px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 142px; height: 30px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="my-input">Nội dung</label>
            <textarea name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>

        </div>
        <div class="form-group mt-3">
            <label for="my-input">Trạng thái:</label>
            <input id="my-input" class="form-check-input" type="radio" name="status" value="1">Công khai
            <input id="my-input" class="form-check-input" type="radio" name="status" value="2">Không công khai
        </div>



        <div class="form-group mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <button type="reset" class="btn btn-danger">Nhập lại</button>
            <a href="{{ route('list.blogs') }}" class="btn btn-success">Danh sách</a>
        </div>
    </form>

@endsection
