@include('client.layouts.header');
@include('client.layouts.sidebar');
<section class="bgwhite ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30 mx-auto">
                <form class="leave-comment" method="POST" action="{{ route('saveLogin.client') }}">
                        @csrf
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Đăng nhập
                    </h4>
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
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email ">
                    </div>

                    <div class="bo4 of-hidden size15 m-b-10">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password"
                            placeholder="Mật khẩu">
                    </div>

                    <div class="m-b-10">
                        <a class=" of-hidden size15 " href="{{ route('forgot.client') }}">
                            Quên mật khẩu?
                        </a>
                    </div>
                    <div class=" of-hidden size15  m-b-10">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg1 hov1 m-text3 trans-0-4" type="submit">
                            Đăng nhập
                        </button>
                    </div>

                    <div class="m-b-10 text-center">
                        <a class=" of-hidden size15  ">
                            --------- Hoặc ---------
                        </a>
                    </div>
                    <div class=" of-hidden size15 m-b-10 ">
                        <!-- Button -->
                        <a class="flex-c-m size2  hov1 m-text3 trans-0-4" style="background: #1877F2" href="">
                            Đăng nhập bằng Facebook
                        </a>
                    </div>
                    <div class=" of-hidden size15 m-b-10 ">
                        <!-- Button -->
                        <a class="flex-c-m size2  hov1 m-text3 trans-0-4" style="background: #666666" href="{{ url('/google') }}">
                            Đăng nhập bằng Google
                        </a>
                    </div>
                    <div class="m-b-10 text-center">
                        Bạn chưa có tài khoản?
                        <a class=" of-hidden size15  " href="{{ route('register.client') }}">
                            Đăng ký tại đây!
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@include('client.layouts.footer');
