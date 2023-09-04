@include('client.layouts.header');
@include('client.layouts.sidebar');
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
    style="background-image: url({{ asset('client/images/heading-pages-01.jpg') }});">
    <h2 class="l-text2 t-center">
        Giỏ hàng
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <form action="{{ route('cap-nhat-gio-hang') }}" method="post">
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart ">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Tên sản phẩm</th>
                            <th class="column-2">Màu sắc</th>
                            <th class="column-2">Kích thước</th>
                            <th class="column-3">Giá</th>
                            <th class="column-4 p-l-70">Số lượng</th>
                            <th class="column-4 p-l-70">Tổng</th>
                            <th class="column-5">Hành động</th>
                        </tr>

                        @foreach ($carts as $value)
                            <input type="hidden" name="id[]" value="{{ $value->id }}">
                            <tr class="table-row">
                                <td class="column-1">

                                        <div class="cart-img-product b-rad-4 o-f-hidden">
                                            <img src="{{ Storage::url($value->product->image) }}" alt="IMG-PRODUCT">
                                        </div>


                                </td>
                                <td class="column-2">{{ $value->product->name }}</td>
                                <td class="column-3">{{ $value->color->name?? "Không" }}</td>
                                <td class="column-4">{{ $value->size->name ?? "Không"}}</td>
                                <td class="column-5">

                                    @if ($value->product->discount_price != null)
                                        {{ number_format($value->product->discount_price, 0, ',', '.') }} VNĐ
                                    @else
                                        {{ number_format($value->product->selling_price, 0, ',', '.') }} VNĐ
                                    @endif

                                </td>
                                <td class="column-6">
                                    <div class="flex-w bo5 of-hidden w-size17">
                                        <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                        <input class="size8 m-text18 t-center num-product" type="number" id="quantity"
                                            name="quantity[]" value="{{ $value->quantity }}">

                                        <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>

                                <td class="column-7">
                                    {{ number_format($value->total, 0, ',', '.') }} VNĐ

                                </td>
                                <td class="column-8">
                                    <?php $cartUrl = '/xoa-san-pham-trong-gio-hang/'; ?>
                                    <a href="{{ route('xoa-san-pham-trong-gio-hang',['id'=>$value->id]) }}"
                                        onclick=" showDeleteConfirm('{{ $value->id }}','{{ $cartUrl }}');">
                                        Xoá
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>

            <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
                <div class="flex-w flex-m w-full-sm">
                    <div class="size11 bo4 m-r-10">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code"
                            placeholder="Coupon Code">
                    </div>

                    <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                        <!-- Button -->
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                            Áp mã giảm giá
                        </button>
                    </div>
                </div>

                @csrf
                <div class="size10 trans-0-4 m-t-10 m-b-10">
                    <!-- Button -->
                    <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        Cập nhật giỏ hàng
                    </button>
                </div>

            </div>
        </form>

        <!-- Total -->
        <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24">
                Tổng
            </h5>

            <!--  -->
            <div class="flex-w flex-sb-m p-b-12">
                <span class="s-text18 w-size19 w-full-sm">
                    Số sản phẩm:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
                    {{ $countCart }}
                </span>
            </div>
            {{-- @php
                $totalPrice = 0;
            @endphp --}}
            @foreach ($carts as $value)
                <!--  -->
                <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                    <span class="s-text18 w-size19 w-full-sm">
                        {{ $value->product->name }}
                    </span>
                    <span class=" ">
                        {{ $value->quantity }}
                    </span>
                    <span class="s-text18 w-size19 w-full-sm">
                        {{ number_format($value->total, 0, ',', '.') }} VNĐ
                    </span>

                </div>

                <!--  -->
                {{-- @php
                    $totalPrice += $value->total;
                @endphp --}}
            @endforeach

            <div class="flex-w flex-sb-m p-t-26 p-b-30">
                <span class="m-text22 w-size19 w-full-sm">
                    Tổng tiền:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
                    {{ number_format($totalPrice, 0, ',', '.') }} VNĐ
                </span>
            </div>
            <div class="size15 trans-0-4">
                <!-- Button -->
                {{-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    Mua hàng
                </button> --}}
                <a href="{{ route('mua-hang') }}" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    Mua hàng
                </a>
            </div>
        </div>
    </div>
</section>
@include('client.layouts.footer');
