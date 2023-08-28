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
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Tổng tiền</th>
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
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->address }}</td>
                    <td> {{ number_format($value->total, 0, ',', '.') }} VNĐ
                    </td>
                    <td>{{ $value->status }} </td>
                    <td>

                        <div class="dropdown">
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-cog'></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('order.detail', $value->id) }}">
                                        Chi
                                        tiết</a></li>
                                @if ($value->status == 'Chờ xác nhận')
                                    <li><a class="dropdown-item" href="{{ route('order.confirm', $value->id) }}">Xác
                                            nhận</a></li>
                                    <li><a class="dropdown-item" href="{{ route('order.cancel', $value->id) }}">Huỷ</a>
                                    </li>
                                @endif

                            </ul>
                        </div>


                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
