<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="topbar">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <span class="topbar-child1">
                Free shipping for standard order over $100
            </span>

            <div class="topbar-child2">
                <span class="topbar-email">
                    fashe@example.com
                </span>

                <div class="topbar-language rs1-select2">
                    <select class="selection-1" name="time">
                        <option>USD</option>
                        <option>EUR</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="wrap_header">
            <!-- Logo -->
            <a href="{{ route('/') }}" class="logo">
                <img src="{{ Storage::url($logo->image_path) }}" alt="IMG-LOGO">
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li class="{{ request()->routeIs('/') ? 'sale-noti' : '' }}">
                            <a href="{{ route('/') }}">Trang chủ</a>
                            <ul class="sub_menu">
                                <li><a href="index.html">Homepage V1</a></li>
                                <li><a href="home-02.html">Homepage V2</a></li>
                                <li><a href="home-03.html">Homepage V3</a></li>
                            </ul>
                        </li>
                        {{-- <li class="{{ request()->routeIs('/') ? 'sale-noti' : '' }}">
                            <a href="{{ route('/') }}">Trang chủ</a>
                            <ul class="sub_menu">
                                <li><a href="index.html">Homepage V1</a></li>
                                <li><a href="home-02.html">Homepage V2</a></li>
                                <li><a href="home-03.html">Homepage V3</a></li>
                            </ul>
                        </li> --}}

                        <li class="{{ request()->routeIs('cua-hang')?'sale-noti':'' }}">
                            <a href="{{ route('cua-hang') }}">Cửa hàng</a>
                        </li>
                        <li>
                            <a href="blog.html">Bài viết</a>
                        </li>

                        <li>
                            <a href="about.html">Giới thiệu</a>
                        </li>

                        <li>
                            <a href="contact.html">Liên hệ</a>
                        </li>
                    </ul>
                </nav>
            </div>

            @if (Auth::check())
                <!-- Header Icon -->
                <div class="header-icons">
                    <ul class="main_menu">
                        <li>
                            <a href="#" class="header-wrapicon1 dis-block">
                                <img src="{{ asset('client/images/icons/icon-header-01.png') }}" class="header-icon1"
                                    alt="ICON">
                            </a>
                            <ul class="sub_menu">
                                <li><a href="index.html">Trang cá nhân</a></li>
                                @if (Auth::user()->role_id == 1)
                                    <li><a href="{{ route('dashboard') }}">Trang quản trị</a></li>
                                @endif
                                <li><a href="{{ route('don-hang') }}">Đơn hàng</a></li>
                                <li><a href="{{ route('logout.client') }}">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>

                    {{-- <a href="#" class="header-wrapicon1 dis-block">
                    <img src="{{ asset('client/images/icons/icon-header-01.png') }}" class="header-icon1" alt="ICON">
                </a> --}}

                    <span class="linedivide1 "></span>

                    <div class="header-wrapicon2 ">
                        <a href="{{ route('gio-hang') }}">
                            <img src="{{ asset('client/images/icons/icon-header-02.png') }}"
                            class="header-icon1 js-show-header-dropdown " alt="ICON">
                        <span class="header-icons-noti">{{ $countCart }}</span>
                        </a>


                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/item-cart-01.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            White Shirt With Pleat Detail Back
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $19.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/item-cart-02.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Converse All Star Hi Black Canvas
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $39.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/item-cart-03.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Nixon Porter Leather Watch In Tan
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $17.00
                                        </span>
                                    </div>
                                </li>
                            </ul>

                            <div class="header-cart-total">
                                Total: $75.00
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="{{ route('login.client') }}">Đăng nhập</a>
                            </li>
                            <li>
                                <a href="{{ route('register.client') }}">Đăng ký</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            @endif
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{ route('/') }}" class="logo-mobile">
            <img src="{{ Storage::url($logo->image_path) }}" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            @if (Auth::check())
                <div class="header-icons-mobile">
                    <ul class="main_menu">
                        <li>
                            <a href="#" class="header-wrapicon1 dis-block">
                                <img src="{{ asset('client/images/icons/icon-header-01.png') }}" class="header-icon1"
                                    alt="ICON">
                            </a>
                            <ul class="sub_menu">
                                <li><a href="index.html">Trang cá nhân</a></li>
                                @if (Auth::user()->role_id == 1)
                                    <li><a href="{{ route('dashboard') }}">Trang quản trị</a></li>
                                @endif
                                <li><a href="home-02.html">Đơn hàng</a></li>
                                <li><a href="{{ route('logout.client') }}">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>

                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <a href="{{ route('gio-hang') }}">
                            <img src="{{ asset('client/images/icons/icon-header-02.png') }}"
                            class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{ $countCart }}</span>
                        </a>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/item-cart-01.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            White Shirt With Pleat Detail Back
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $19.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/item-cart-02.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Converse All Star Hi Black Canvas
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $39.00
                                        </span>
                                    </div>
                                </li>

                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="images/item-cart-03.jpg" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            Nixon Porter Leather Watch In Tan
                                        </a>

                                        <span class="header-cart-item-info">
                                            1 x $17.00
                                        </span>
                                    </div>
                                </li>
                            </ul>

                            <div class="header-cart-total">
                                Total: $75.00
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login.client') }}" class="header-wrapicon1 dis-block ">
                    <img src="{{ asset('client/images/icons/icon-header-01.png') }}" class="header-icon1 "
                        alt="ICON">
                </a>
            @endif
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu">
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <span class="topbar-child1">
                        Free shipping for standard order over $100
                    </span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
                        <span class="topbar-email">
                            fashe@example.com
                        </span>

                        <div class="topbar-language rs1-select2">
                            <select class="selection-1" name="time">
                                <option>USD</option>
                                <option>EUR</option>
                            </select>
                        </div>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="index.html">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Homepage V1</a></li>
                        <li><a href="home-02.html">Homepage V2</a></li>
                        <li><a href="home-03.html">Homepage V3</a></li>
                    </ul>
                    <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{ route('cua-hang') }}">Shop</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.html">Sale</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="cart.html">Features</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="blog.html">Blog</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="about.html">About</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
