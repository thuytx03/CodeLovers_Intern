@include('client.layouts.header');
@include('client.layouts.sidebar');
<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m"
    style="background-image: url({{ asset('client/images/heading-pages-02.jpg') }});">
    <h2 class="l-text2 t-center">
        Women
    </h2>
    <p class="m-text13 t-center">
        New Arrivals Women Collection 2018
    </p>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <h4 class="m-text14 p-b-7">
                        Danh mục sản phẩm
                    </h4>

                    <ul class="p-b-54">
                        <li class="p-t-4">
                            <a href="{{ route('cua-hang') }}"
                                class="s-text13 {{ request()->routeIs('cua-hang') ? 'active1' : '' }}">
                                Tất cả
                            </a>
                        </li>
                        @foreach ($categories->where('parent_id', 0) as $parent)
                            <li class="p-t-4">
                                <a href="{{ route('cua-hang', ['category' => $parent->id]) }}"
                                    class="s-text13 {{ request()->routeIs('cua-hang', ['category' => $parent->id]) ? 'active1' : '' }}">
                                    {{ $parent->name }}
                                </a>
                            </li>
                            @foreach ($categories->where('parent_id', $parent->id) as $child)
                                <li class="p-t-4">
                                    <a href="{{ route('cua-hang', ['category' => $child->id]) }}" class="s-text13 ">
                                        - {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endforeach


                    </ul>

                    <!--  -->
                    <h4 class="m-text14 p-b-32">
                        Filters
                    </h4>

                    <div class="filter-price p-t-22 p-b-50 bo3">
                        <div class="m-text15 p-b-17">
                            Price
                        </div>

                        <div class="wra-filter-bar">
                            <div id="filter-bar"></div>
                        </div>

                        <div class="flex-sb-m flex-w p-t-16">
                            <div class="w-size11">
                                <!-- Button -->
                                <button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
                                    Filter
                                </button>
                            </div>

                            <div class="s-text3 p-t-10 p-b-10">
                                Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
                            </div>
                        </div>
                    </div>

                    <div class="filter-color p-t-22 p-b-50 bo3">
                        <div class="m-text15 p-b-12">
                            Color
                        </div>

                        <ul class="flex-w">
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter1" type="checkbox"
                                    name="color-filter1">
                                <label class="color-filter color-filter1" for="color-filter1"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter2" type="checkbox"
                                    name="color-filter2">
                                <label class="color-filter color-filter2" for="color-filter2"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter3" type="checkbox"
                                    name="color-filter3">
                                <label class="color-filter color-filter3" for="color-filter3"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter4" type="checkbox"
                                    name="color-filter4">
                                <label class="color-filter color-filter4" for="color-filter4"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter5" type="checkbox"
                                    name="color-filter5">
                                <label class="color-filter color-filter5" for="color-filter5"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter6" type="checkbox"
                                    name="color-filter6">
                                <label class="color-filter color-filter6" for="color-filter6"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter7" type="checkbox"
                                    name="color-filter7">
                                <label class="color-filter color-filter7" for="color-filter7"></label>
                            </li>
                        </ul>
                    </div>

                    <div class="search-product  bo4 ">

                        <input class="s-text7 size6 p-l-23 p-r-50 " type="text " id="search" name="search"
                            placeholder="Search Products...">

                        <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                            <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                        </button>


                    </div>


                </div>
            </div>


            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                                <option>Default Sorting</option>
                                <option>Popularity</option>
                                <option>Price: low to high</option>
                                <option>Price: high to low</option>
                            </select>
                        </div>

                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <select class="selection-2" name="sorting">
                                <option>Price</option>
                                <option>$0.00 - $50.00</option>
                                <option>$50.00 - $100.00</option>
                                <option>$100.00 - $150.00</option>
                                <option>$150.00 - $200.00</option>
                                <option>$200.00+</option>

                            </select>
                        </div>
                    </div>

                    <span class="s-text8 p-t-5 p-b-5">
                        Showing 1–12 of 16 results
                    </span>
                </div>

                <!-- Product -->
                <div class="row">
                    @foreach ($products as $value)
                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
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
                                        <input type="hidden" name="product_id" value="{{ $value->id }}">
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
                                            <del>{{ number_format($value->selling_price, 0, ',', '.') }} VNĐ</del>
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

                <!-- Pagination -->
                <div class="pagination flex-m flex-w p-t-26">
                    {{-- <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
                    <a href="#" class="item-pagination flex-c-m trans-0-4">2</a> --}}
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@include('client.layouts.footer')
