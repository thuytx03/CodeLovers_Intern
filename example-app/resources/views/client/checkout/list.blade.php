@include('client.layouts.header');
@include('client.layouts.sidebar');
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
    style="background-image: url({{ asset('client/images/heading-pages-01.jpg') }});">
    <h2 class="l-text2 t-center">
        Đơn hàng
    </h2>
</section>

<!--  -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <table class="table-shopping-cart ">
                    <tr class="table-head">
                        <th class="column-1">Thông tin </th>
                        <th class="column-1">Số sản phẩm </th>
                        <th class="column-1">Thời gian </th>

                        <th class="column-1 ">Tổng tiền</th>
                        <th class="column-1 ">Trạng thái</th>
                        <th class="column-1">Hành động</th>
                    </tr>

                    @foreach ($order as $value)
                        <tr class="table-row">
                            <td class="column-1 ">
                                Tên: {{ $value->name }} <br>
                                SĐT: {{ $value->phone }} <br>
                                Địa chỉ: {{ $value->address }} <br>
                            </td>
                            <td class="column-1 ">
                                {{ $orderQuantities[$value->id] }}
                            </td>
                            <td class="column-1 ">
                                {{ $value->created_at }}
                            </td>
                            <td class="column-1">
                                {{ number_format($value->total, 0, ',', '.') }} VNĐ
                            </td>
                            <td class="column-1">
                                {{ $value->status }}
                            </td>
                            <td class="column-1">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bx bx-cog'></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('order.detail', $value->id) }}">
                                                Chi
                                                tiết</a></li>
                                        @if ($value->status == 'Chờ xác nhận' || $value->status == 'Chờ lấy hàng')
                                            <li>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#cancelOrderModal">Huỷ đơn hàng</a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog"
                            aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelOrderModalLabel">Huỷ đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('order.cancel.client', $value->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cancelReason">Lý do huỷ đơn hàng:</label>
                                                <textarea class="form-control" id="cancelReason" name="cancel_reason" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Xác nhận huỷ đơn hàng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            {{ $order->links() }}
        </div>
    </div>

</section>

@include('client.layouts.footer');
