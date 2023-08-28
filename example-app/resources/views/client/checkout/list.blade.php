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
                        <th class="column-1">Tên </th>
                        <th class="column-1">Số điện thoại</th>
                        <th class="column-1">Email</th>
                        <th class="column-4">Địa chỉ</th>
                        <th class="column-4 ">Tổng tiền</th>
                        <th class="column-5 ">Trạng thái</th>
                        <th class="column-4">Hành động</th>
                    </tr>

                    @foreach ($order as $value)
                        <tr class="table-row">
                            <td class="column-1 ">
                                {{ $value->name }}
                            </td>
                            <td class="column-1">{{ $value->phone }}</td>
                            <td class="column-1">{{ $value->email }}</td>
                            <td class="column-4">{{ $value->address }}</td>
                            <td class="column-4">
                                {{ number_format($value->total, 0, ',', '.') }} VNĐ
                            </td>
                            <td class="column-4">
                                {{ $value->status }}
                            </td>
                            <td class="column-8">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-cog'></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('order.detail', $value->id) }}">
                                                Chi
                                                tiết</a></li>
                                        @if ($value->status == 'Chờ xác nhận')
                                            
                                            <li><a class="dropdown-item" href="{{ route('order.cancel', $value->id) }}">Huỷ</a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>





    </div>
</section>
@include('client.layouts.footer');
