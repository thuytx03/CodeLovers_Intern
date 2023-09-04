@include('client.layouts.header');
@include('client.layouts.sidebar');
<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="index.html" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="product.html" class="s-text16">
        Women
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="#" class="s-text16">
        T-Shirt
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Boxy T-Shirt with Roll Sleeve Detail
    </span>
</div>
<form action="{{ route('them-gio-hang') }}" method="post">
    @csrf
    <!-- Product Detail -->
    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        @foreach ($productImage as $value)
                            <div class="item-slick3" data-thumb="{{ Storage::url($value->image_path) }}">
                                <div class="wrap-pic-w">
                                    <img src="{{ Storage::url($value->image_path) }}" alt="IMG-PRODUCT">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{ $product->name }}
                </h4>
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                @if ($product->discount_price != null)
                    <span class="block2-price m-text6 p-r-5 text-danger">
                        {{ number_format($product->discount_price, 0, ',', '.') }} VNĐ

                    </span>
                    <span class="block2-price m-text6 p-r-5">
                        <del> {{ number_format($product->selling_price, 0, ',', '.') }} VNĐ</del>


                    </span>
                @else
                    <span class="block2-price m-text6 p-r-5 text-danger">
                        {{ number_format($product->selling_price, 0, ',', '.') }} VNĐ

                    </span>
                @endif

                <p class="s-text8 p-t-10">
                    Số lượng: {{ $product->quantity == 0 ? 'Hết hàng' : $product->quantity }}
                </p>

                @if ($product->quantity == 0)
                    <h3 class="m-3">Sản phẩm hiện đang hết hàng</h3>
                @else
                    <div class="p-t-33 p-b-60">
                        @if($productSize->isEmpty() && $productColor->isEmpty() )
                        FreeSize
                        @else
                        <div class="flex-m flex-w p-b-10">
                            <div class="s-text15 w-size15 t-center">
                                Kích cỡ
                            </div>

                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                <select class="selection-2" name="size_id">
                                    {{-- <option value="">Vui lòng chọn</option> --}}
                                    @foreach ($productSize as $value)
                                        <option value="{{ $value->size_id }}">{{ $value->sizes->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="flex-m flex-w">
                            <div class="s-text15 w-size15 t-center">
                                Màu sắc
                            </div>

                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                <select class="selection-2" name="color_id">
                                    {{-- <option value="">Vui lòng chọn</option> --}}
                                    @foreach ($productColor as $value)
                                        <option value="{{ $value->color_id }}">{{ $value->colors->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif


                        <div class="flex-r-m flex-w p-t-10">
                            <div class="w-size16 flex-m flex-w">
                                <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                    </button>

                                    <input class="size8 m-text18 t-center num-product" type="number" name="quantity"
                                        value="1">

                                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>

                                <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                    <!-- Button -->
                                    <button type="submit"
                                        class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



                {{-- <div class="p-b-45">
                <span class="s-text8 m-r-35">SKU: MUG-01</span>
                <span class="s-text8">Categories: Mug, Design</span>
            </div> --}}

                <!--  -->
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Description
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            <?= $product->description ?>
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Additional information
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel
                            sed
                            velit. Proin gravida arcu nisl, a dignissim mauris placerat
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Reviews (0)
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel
                            sed
                            velit. Proin gravida arcu nisl, a dignissim mauris placerat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Sản phẩm liên quan
            </h3>
        </div>

        <!-- Slide2 -->
        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                @foreach ($relatedProducts as $value)
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div
                                class="block2-img wrap-pic-w of-hidden pos-relative {{ $value->features == 1 ? 'block2-labelnew' : ($value->features == 2 ? 'block2-labelsale' : '') }}">
                                <img src="{{ Storage::url($value->image) }}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                        <a href="{{ route('chi-tiet-san-pham', ['slug' => $value->slug, 'id' => $value->id]) }}"
                                            class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="{{ route('chi-tiet-san-pham', ['slug' => $value->slug, 'id' => $value->id]) }}"
                                    class="block2-name dis-block s-text3 p-b-5">
                                    {{ $value->name }}
                                </a>
                                @if ($value->discount_price != null)
                                    <span class="block2-price m-text6 p-r-5 text-danger">
                                        {{ number_format($value->discount_price, 0, ',', '.') }} VNĐ
                                    </span>
                                    <span class="block2-price m-text6 p-r-5">
                                        <del>
                                            {{ number_format($value->selling_price, 0, ',', '.') }} VNĐ
                                        </del>
                                    </span>
                                @else
                                    <span class="block2-price m-text6 p-r-5 text-danger">
                                        {{ number_format($value->selling_price, 0, ',', '.') }} VNĐ
                                    </span>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</section>
@include('client.layouts.footer');
