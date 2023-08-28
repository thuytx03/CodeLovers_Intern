@extends('admin.layouts.main')
@section('home-content')
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
            {{-- <form action="{{ route('update.product', ['id' => $product->id]) }}" method="POST"> --}}
                {{-- @csrf
                @method('PUT') --}}
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tên</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Danh mục</label>
                    <div class="col-sm-10  ">
                        <select class="form-select " name="category_id">
                            @foreach ($category as $cate)
                                <option class="" @if ($cate->id == $product->category_id)value="{{ $cate->id }}" selected @endif disabled
                                    >{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Ảnh bìa</label>
                    <div class="col-sm-10">
                        <input type="text" name="cover_image" class="form-control" value="{{ $product->name }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand" class="form-control" value="{{ $product->brand }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá gốc</label>
                    <div class="col-sm-10">
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Sale</label>
                    <div class="col-sm-10">
                        <input type="text" name="sale" class="form-control" value="{{ $product->sale }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá sale</label>
                    <div class="col-sm-10">
                        <input type="text" name="price_new" class="form-control" value="{{ $product->price_new }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Số lượng</label>
                    <div class="col-sm-10">
                        <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Lượt yêu thích</label>
                    <div class="col-sm-10">
                        <input type="text" name="like" class="form-control" value="{{ $product->like }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Lượt xem</label>
                    <div class="col-sm-10">
                        <input type="text" name="view" class="form-control" value="{{ $product->view }}" disabled>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Trạng thái</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="1"
                                {{ $product->status == 1 ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="gridRadios1">
                                Còn hàng
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="2"
                                {{ $product->status == 2 ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="gridRadios2">
                                Không còn hàng
                            </label>
                        </div>

                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <form action="{{ route('destroy.product',['id'=>$product->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm {{ $product->name }} không?')"  class="btn btn-danger">Xoá</button>
                            <a href="{{ route('edit.product',['id'=>$product->id]) }}" class="btn btn-primary">Chỉnh sửa</a>
                            <a href="{{ route('create.product') }}" class="btn btn-success">Thêm mới</a>
                            <a href="{{ route('list.product') }}" class="btn btn-warning text-white">Danh sách</a>
                        </form>

                    </div>
                </div>

            {{-- </form> --}}

        </div>
    </div>
@endsection
