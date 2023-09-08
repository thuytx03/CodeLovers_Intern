@extends('admin.layouts.main')
@section('content')
    <h1>{{ $title }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mã giảm giá</h5>
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
            <form action="{{ route('edit.coupon',['id'=>$coupon->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Mã code:</label>
                    <div class="col-sm-10">
                        <input type="text" name="code" class="form-control" value="{{ $coupon->code }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Loại giảm giá</label>
                    <div class="col-sm-10">
                        <select name="type" id="" class="form-select">
                            <option value="">Vui lòng chọn</option>
                            <option value="1" {{ $coupon->type==1? "selected" : "" }} >Giảm giá theo phần trăm</option>
                            <option value="2" {{ $coupon->type==2? "selected" : "" }}>Giảm giá theo giá</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá trị giảm giá (Số tiền, số %)</label>
                    <div class="col-sm-10">
                        <input type="text" name="value" class="form-control" value="{{ $coupon->value }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Số lượng</label>
                    <div class="col-sm-10">
                        <input type="text" name="quantity" class="form-control" value="{{ $coupon->quantity }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá trị tối thiểu</label>
                    <div class="col-sm-10">
                        <input type="text" name="min_order_amount" class="form-control"
                            value="{{ $coupon->min_order_amount }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá trị tối đa</label>
                    <div class="col-sm-10">
                        <input type="text" name="max_order_amount" class="form-control"
                            value="{{ $coupon->max_order_amount }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="start_date" class="form-control" value="{{ $coupon->start_date }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="end_date" class="form-control" value="{{$coupon->end_date}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" cols="30" rows="10">{{ $coupon->description }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{ route('list.coupon') }}" class="btn btn-success text-white">Danh sách</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
