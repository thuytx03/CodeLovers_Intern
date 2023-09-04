@include('client.layouts.header');
@include('client.layouts.sidebar');
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
    style="background-image: url({{ asset('client/images/heading-pages-01.jpg') }});">
    <h2 class="l-text2 t-center">
        Mua hàng
    </h2>
</section>

<div class="container">
    <form action="{{ route('client.coupon.check') }}" method="post">
        @csrf
        <div class="p-t-40">
            <i>Mỗi đơn hàng chỉ được áp dụng một mã giảm giá!</i>

        </div>

        <div class="flex-w flex-m w-full-sm">
            <div class="size11 bo4 m-r-10">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon_code"
                    placeholder="Nhập mã giảm giá">
            </div>

            <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                <!-- Button -->
                <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    Áp mã giảm giá
                </button>
            </div>
        </div>
    </form>

</div>

<!-- Checkout -->
<form action="{{ route('dat-hang') }}" method="post">
    @csrf
    <section class="cart bgwhite pt-10  p-b-100">
        <div class="container">
            <div class="row">
                <!--  item -->

                <div class="col-md-6 p-t-30">
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
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" value="{{ old('name') }}" type="text"
                            name="name" placeholder="Họ và tên ">
                    </div>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" value="{{ old('email') }}" type="text"
                            name="email" placeholder="Email ">
                    </div>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" value="{{ old('address') }}" type="text"
                            name="address" placeholder="Địa chỉ ">
                    </div>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" value="{{ old('phone') }}" type="text"
                            name="phone" placeholder="Số điện thoại ">
                    </div>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="{{ old('note') }}"
                            name="note" placeholder="Ghi chú ">
                    </div>

                    <div class=" p-b-35">
                        <div class="rs2-select2 bo4 of-hidden sizefull m-t-5 m-b-5 m-r-10">
                            <select class="selection-2 w-100" name="payment">
                                <option value="" class="sizefull s-text7 p-l-22 p-r-22">Phương thức thanh toán
                                </option>
                                <option value="pay_later" {{ old('payment') == 1 ? 'selected' : '' }}>Thanh toán khi
                                    nhận
                                    hàng</option>
                                <option value="online_payment" {{ old('payment') == 2 ? 'selected' : '' }}>Thanh toán
                                    qua thẻ
                                    ngân hàng</option>
                            </select>
                        </div>
                    </div>


                </div>

                <!-- Total -->
                <div class="col-md-6">
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

                        <!-- ... -->
                        <div class="flex-w flex-sb-m p-t-26 p-b-30">
                            <span class="m-text22 w-size19 w-full-sm">
                                Tổng tiền:
                            </span>
                            @if (session('coupon'))
                                <span class="m-text21 w-size20 w-full-sm">
                                    {{ number_format(session('coupon.totalCoupon'), 0, ',', '.') }} VNĐ
                                </span>
                                <input type="hidden" name="totalPrice" value="{{ session('coupon.totalCoupon') }}">
                            @else
                                <span class="m-text21 w-size20 w-full-sm">
                                    {{ number_format($totalPrice, 0, ',', '.') }} VNĐ
                                </span>
                                <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                            @endif
                        </div>
                        <!-- ... -->

                        <div class="size15 trans-0-4">
                            <!-- Button -->
                            {{-- <input type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" name="redirect" value="Thanh toán bằng VnPay">
                        <input type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" name="payment"  value="Thanh toán khi nhận hàng"> --}}

                            <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Đặt hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</form>

@include('client.layouts.footer');
