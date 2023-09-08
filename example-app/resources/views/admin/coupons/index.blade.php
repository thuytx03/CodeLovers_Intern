@extends('admin.layouts.main')

@section('content')
<form action="{{ route('deleteAll.coupon') }}" method="post" id="delete-form">
    @csrf
    <div class="card">
        <div class="card-body">
            <h1>{{ $title }}</h1>

            <div class="d-flex justify-content-end mt-3 mb-3">
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hành động
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('add.coupon') }}">Thêm mới</a></li>
                        <li><a class="dropdown-item" href="{{ route('trash.product') }}">Thùng rác</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);"
                                onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-striped text-center mb-3">
                    <thead>
                        <tr>
                            <td>
                                <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                            </td>
                            <th scope="col">Mã giảm giá</th>
                            <th scope="col">Loại</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tối thiểu -> Tối đa</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày bắt đầu</th>
                            <th scope="col">Ngày kết thúc</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $key => $value)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input" name="ids[{{ $value->id }}]"
                                        value="{{ $value->id }}">
                                </td>
                                <td>{{ $value->code }}</td>
                                <td>{{ $value->type==1? 'Giảm theo %' : 'Giảm theo giá' }}</td>
                                <td>{{ $value->value }}</td>
                                <td>{{ $value->quantity }}</td>
                                @if($value->min_order_amount == "" && $value->max_order_amount== "")
                                <td> Tất cả</td>
                                @elseif($value->min_order_amount != "" && $value->max_order_amount == "")
                                <td>Đơn từ {{ $value->min_order_amount }}</td>
                                @elseif($value->max_order_amount != "" && $value->min_order_amount=="")
                                <td>Đơn tối đa {{ $value->max_order_amount }}</td>
                                @elseif($value->min_order_amount != "" && $value->max_order_amount!= "")
                                <td> Đơn từ {{ $value->min_order_amount }} đến {{ $value->max_order_amount }}</td>
                                @endif
                                <td>{{ $value->start_date }}
                                </td>
                                <td>{{ $value->end_date }}</td>

                                <td>{{ $value->status == 1 ? 'Còn hạn' : 'Hết hạn' }}</td>
                                <td>
                                    <?php $couponUrl = '/admin/coupons/destroy/'; ?>
                                    <a href="/admin/coupons/destroy/{{ $value->id }}"
                                        onclick="event.preventDefault(); showDeleteConfirm('{{ $value->id }}','{{ $couponUrl }}');"
                                        class="btn btn-danger"><i class='bx bx-trash'></i></a>
                                    <a href="/admin/coupons/edit/{{ $value->id }}" class="btn btn-primary"><i
                                            class='bx bx-edit'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
            {{ $coupons->links() }}
        </div>
    </div>
@endsection
