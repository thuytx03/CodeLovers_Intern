@include('client.layouts.header');
@include('client.layouts.sidebar');
<section class="bgwhite ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30 mx-auto">
                <form class="leave-comment" method="POST" action="{{ route('saveForgot.client') }}">
                        @csrf
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Quên mật khẩu
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
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email " value="{{ old('email') }}">
                    </div>


                    <div class=" of-hidden size15  m-b-20">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg1 hov1 m-text3 trans-0-4" type="submit">
                            Lấy lại mật khẩu
                        </button>
                    </div>


                    <div class="m-b-10 text-center">
                        Bạn đã có tài khoản?
                        <a class=" of-hidden size15  " href="{{ route('login.client') }}">
                            Đăng nhập tại đây!
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@include('client.layouts.footer');
