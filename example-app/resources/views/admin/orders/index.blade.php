@extends('admin.layouts.main')
@section('content')
    <h1>Quản lý đơn hàng</h1>

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
    <!-- Table with stripped rows -->
    <table class="table table-striped text-center ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Tổng tiền</th>
                <th>THời gian</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $value)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                    <td> {{ number_format($value->total, 0, ',', '.') }} VNĐ
                    </td>
                    <td>{{ $value->created_at }}</td>
                    <td><span class="badge bg-label-primary me-1">{{ $value->status }}</span> </td>
                    <td>

                        <div class="dropdown">
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-cog'></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('order.detail', $value->id) }}">Chi tiết</a>
                                </li>
                                @if ($value->status != 'Chờ lấy hàng')
                                    <li><a class="dropdown-item" href="{{ route('order.confirm', $value->id) }}">Chờ lấy
                                            hàng</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('order.delivering', $value->id) }}">Đang
                                        giao</a></li>
                                <li><a class="dropdown-item" href="{{ route('order.delivered', $value->id) }}">Đã giao</a>
                                </li>
                                @if ($value->status != 'Đã huỷ')
                                <li>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#cancelOrderModal">Huỷ đơn hàng</a>
                                </li>
                                @endif


                            </ul>
                        </div>


                    </td>

                </tr>
                <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog"
                            aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelOrderModalLabel">Huỷ đơn hàng</h5>
                                        <button type="button " class="close " style="border:none; background:none" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('order.cancel', $value->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cancelReason">Lý do huỷ đơn hàng:</label>
                                                <textarea class="form-control" id="cancelReason" name="cancel_reason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger mt-3">Xác nhận huỷ đơn hàng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            @endforeach


        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
