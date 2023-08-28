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

        <form action="/admin/interfaces/logo/{{ $logo->id }}" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="image" class="col-sm-2 col-form-label">Ảnh bìa</label>
                <div class="col-sm-10">
                    <input type="file" name="image_path" id="image" class="form-control"
                        value="">
                    <img id="preview-image" src="{{ Storage::url($logo->image_path) }}" alt="Ảnh sản phẩm"
                        style="max-width: 200px; margin-top:15px">
                </div>
            </div>
            <div class="form-group mt-3">
                @csrf

               <button type="submit" class="btn btn-primary">Cập nhật</button>
               <button type="reset" class="btn btn-danger">Nhập lại</button>
                {{-- <a href="{{ route('list.role') }}" class="btn btn-success">Danh sách</a> --}}
            </div>
        </form>

@endsection
