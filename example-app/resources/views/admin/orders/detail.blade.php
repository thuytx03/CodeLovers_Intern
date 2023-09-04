@extends('admin.layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <h3 class="card-header">Chi tiết hoá đơn</h3>
            <div class="card-body">
                <div class="row">
                    <h5 class="col-6">Tên khách hàng: {{ $order->name }}</h5>
                    <h5 class="col-6">Email: {{ $order->email }}</h5>
                    <h5 class="col-6">Số điện thoại: {{ $order->phone }}</h5>
                    <h5 class="col-6">Địa chỉ: {{ $order->address }}</h5>
                    <h5 class="col-6">Thời gian: {{ $order->created_at }}</h5>
                    <h5 class="col-6 text-danger">Phương thức thanh toán:
                        {{ $order->payment == 'online_payment' ? 'VNPay' : 'Thanh toán khi nhận hàng' }}</h5>
                    <h5 class="col-6 text-danger">Trạng thái thanh toán:
                        {{ $order->payment == 'online_payment' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                    </h5>
                    @if($order->status== 'Đã huỷ')
                    <h5 class="col-6 text-danger">Lý do huỷ:
                        {{ $order->cancel_reason  }}
                    </h5>
                    @endif
                </div>
                <h4 class="mt-1 mb-1">Sản phẩm đặt mua</h4>
                <div class="table-responsive text-nowrap text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Kích thước</th>
                                <th>Màu sắc</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($order_detail as $value)
                                <tr>
                                    <td>{{ $value->product->name }}</td>
                                    <td>
                                        <img src="{{ Storage::url($value->product->image) }}" width="50" alt="">
                                    </td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->size->name }}</td>
                                    <td>{{ $value->color->name }}</td>
                                    <td>{{ $value->price }}</td>
                                    <td><span class="badge bg-label-primary me-1">{{ $order->status }}</span></td>

                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-danger">Tổng tiền: {{ $order->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
