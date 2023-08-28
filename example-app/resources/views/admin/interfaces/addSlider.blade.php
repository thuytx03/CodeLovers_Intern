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

        <form action="{{ route('saveAdd.slider') }}" method="post" enctype="multipart/form-data">
            <div class="form-group mt-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nội dung</label>
                <div class="col-sm-12">
                    <textarea name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="my-input">Banner</label>
                <input type="file" name="image" id="image" class="form-control">
                <img id="preview-image" class="mt-3 " src="#" alt="Ảnh sản phẩm"
                    style="max-width: 200px; border-radius:5px; height:150px">
            </div>

            <fieldset class="form-group mt-3">
                <legend class="col-form-label col-sm-2 pt-0">Trạng thái</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="1"
                            {{ old('status') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="gridRadios1">
                           Kích hoạt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="2"
                            {{ old('status') == 2 ? 'checked' : '' }}>
                        <label class="form-check-label" for="gridRadios2">
                            Không kích hoạt
                        </label>
                    </div>

                </div>
            </fieldset>

            <div class="form-group mt-3">
                @csrf
               <button type="submit" class="btn btn-primary">Thêm mới</button>
               <button type="reset" class="btn btn-danger">Nhập lại</button>
                <a href="{{ route('list.slider') }}" class="btn btn-success">Danh sách</a>
            </div>
        </form>

@endsection
