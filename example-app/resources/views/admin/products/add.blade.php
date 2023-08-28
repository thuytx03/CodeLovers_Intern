@extends('admin.layouts.main')
@section('content')
    <h1>Quản lý sản phẩm</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Sản phẩm</h5>
            @if (session('success'))
                <div class="alert alert-success">
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
            <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tên đường dẫn</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                    </div>
                </div>
                <style>
                    .card-body {
                        overflow: auto;
                    }
                </style>
                <div class="form-group mt-3">
                    <label for="my-input">Danh mục sản phẩm</label>
                    <div class="col-md-12 col-sm-12">
                        <div class="card overflow-hidden mb-4" style="height: auto; overflow-y: auto;">
                            <div class="card-body ps ps--active-y" id="vertical-example">
                                @foreach ($data->where('parent_id', 0) as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" name="category_id[]" type="checkbox"
                                            value=" {{  $item->id }}" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                    @foreach ($data->where('parent_id', $item->id) as $children)
                                        <div class="form-check">
                                            <input class="form-check-input" name="category_id[]" type="checkbox"
                                                value=" {{ $children->id }}" id="flexCheckDefault" style="margin-left:5px;">
                                            <label class="form-check-label" style="margin-left:5px;" for="flexCheckDefault">
                                                {{ $children->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach
                                <div class="ps__rail-x" style="left: 0px; bottom:auto;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: auto; height: 200px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0; height: 0;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Ảnh bìa</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
                        <img id="preview-image" src="#" alt="Ảnh sản phẩm" style="max-width: 200px;">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="images" class="col-sm-2 col-form-label">Ảnh sản phẩm</label>
                    <div class="col-sm-10 image-container">
                        <input type="file" name="images[]" id="images" class="form-control" value="{{ old('images') }}" multiple>
                    </div>


                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá bán gốc</label>
                    <div class="col-sm-10">
                        <input type="text" name="selling_price" class="form-control" value="{{ old('selling_price') }}">
                    </div>
                </div>
                <p class="cursor-pointer text-danger" onclick="toggleInputs()">Bạn có muốn giảm giá sản phẩm không? Có => Click</p>

                <div id="inputsContainer" style="display: none;">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Giảm theo giá</label>
                        <div class="col-sm-10">
                            <input type="text" name="discount_price" class="form-control" value="{{ old('discount_price') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Giảm theo phần trăm</label>
                        <div class="col-sm-10">
                            <input type="text" name="percent" class="form-control" value="{{ old('percent') }}">
                        </div>
                    </div>
                </div>

                <script>
                    function toggleInputs() {
                        var inputsContainer = document.getElementById('inputsContainer');
                        if (inputsContainer.style.display === 'none') {
                            inputsContainer.style.display = 'block';
                        } else {
                            inputsContainer.style.display = 'none';
                        }
                    }
                </script>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Số lượng</label>
                    <div class="col-sm-10">
                        <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Size</legend>
                    <div class="col-sm-10 ">
                        @foreach ($size as $item)
                            <input class="form-check-input" name="size_id[]" type="checkbox"
                                value="{{ $item->id }}" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                {{ $item->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Color</legend>
                    <div class="col-sm-10 ">
                        @foreach ($color as $item)
                            <input class="form-check-input" name="color_id[]" type="checkbox"
                                value="{{ $item->id }}" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                {{ $item->name }}
                            </label>
                        @endforeach
                    </div>
                </div>



                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Đặc trưng</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="features" value="1"
                                {{ old('features') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios1">
                                New
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="features" value="2"
                                {{ old('features') == 2 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios2">
                                Sale
                            </label>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Trạng thái</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="1"
                                {{ old('status') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios1">
                                Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="2"
                                {{ old('status') == 2 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios2">
                                Không công khai
                            </label>
                        </div>

                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{ route('list.product') }}" class="btn btn-success text-white">Danh sách</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
