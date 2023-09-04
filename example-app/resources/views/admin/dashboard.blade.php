@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 ">
        <div class="row">
            <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="cl-lg-4 col-md-4 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Đơn hàng mới</span>
                                <h3 class="card-title mb-2">{{ $newOrderCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="cl-lg-4 col-md-4 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Chờ xác nhận</span>
                                <h3 class="card-title mb-2">{{ $pendingOrdersCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="cl-lg-4 col-md-4 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Doanh thu</span>
                                <h3 class="card-title mb-2">
                                    {{ number_format($revenue, 0, ',', '.') }} VNĐ

                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="text-muted">Top 10 Sản Phẩm Có Lượt Xem Cao Nhất</h6>
                        <ul class="p-0 m-0">
                            @foreach ($topProductsMonth as $value)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Storage::url($value->image) }}" alt="User" class="rounded">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $value->name }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">{{ $value->view }}</h6>
                                            <span class="text-muted">Lượt xem</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
                
            </div>


        </div>

    </div>
@endsection
