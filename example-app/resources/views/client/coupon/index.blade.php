@include('client.layouts.header')
@include('client.layouts.sidebar')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m"
    style="background-image: url({{ asset('client/images/heading-pages-06.jpg') }});">
    <h2 class="l-text2 t-center">
        Mã giảm giá
    </h2>
</section>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: cursive;
        box-sizing: border-box;
    }

    /* .contai {
        width: 100%;
        height: 100vh;
        background: #f0fff9;
        display: flex;
        align-items: center;
        justify-content: center;
    } */

    .coupon-card {
        background: linear-gradient(135deg, #7185fe, #9d4de6);
        color: #fff;
        text-align: center;
        /* padding: 40px 80px; */
        /* margin: 5px; */
        border-radius: 15px;
        box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.10);
        position: relative;
    }

    .coupon-card h3 {
        font-size: 28px;
        font-weight: 400;
        margin: 25px auto;
        width: fit-content;
    }

    .coupon-card p {
        font-size: 15px;
    }

    .coupon-row {
        /* display: flex;
        align-items: center; */
        margin: 25px auto;
        /* width: fit-content; */
    }

    /* .coupon-row p {
        margin-left: 10px;
    } */

    .cpncode {
        border: 1px dashed #fff;
        padding: 10px 20px;
        border-right: 0;
    }

    .cpnbtn {
        border: 1px dashed #fff;
        padding: 10px 20px;
        cursor: pointer;
        color: #7185fe;
    }

    .circle1 .circle2 {
        background: #f0fff9;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        transform: translateY(50%);
    }

    .circle1 {
        left: -25px;
    }

    .circle2 {
        right: -25px;
    }
</style>
<!-- content page -->
<section class="bgwhite p-t-66 p-b-60">
    <div class="container p-3">
        <div class="row">
            @foreach ($coupon as $value)
                <div class="coupon-card card col-md-5 m-4     ">
                    @if ($value->min_order_amount == '' && $value->max_order_amount == '')
                        <h3>Giảm tất cả đơn hàng</h3>
                    @elseif($value->min_order_amount != '' && $value->max_order_amount == '')
                        <h3>Đơn từ {{ $value->min_order_amount }}</h3>
                    @elseif($value->max_order_amount != '' && $value->min_order_amount == '')
                        <h3>Đơn tối đa {{ $value->max_order_amount }}</h3>
                    @elseif($value->min_order_amount != '' && $value->max_order_amount != '')
                        <h3>Đơn từ {{ $value->min_order_amount }} đến {{ $value->max_order_amount }}</h3>
                    @endif
                    <div class="coupon-row">
                        <span class="cpncode">{{ $value->code }}</span>
                        <span class="cpnbtn">Copy</span>
                        <p class="m-t-25 text-white">Hạn đến {{ $value->created_at }}</p>
                        <div class="circle1"></div>
                        <div class="circle2"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            var cpnbtns = document.querySelectorAll(".cpnbtn");

            cpnbtns.forEach(function(cpnbtn) {
                cpnbtn.addEventListener("click", function() {
                    var cpncode = this.previousElementSibling;
                    navigator.clipboard.writeText(cpncode.textContent).then(function() {
                        cpnbtn.textContent = "Copied";
                        setTimeout(function() {
                            cpnbtn.textContent = "Copy";
                        }, 3100);
                    }).catch(function(err) {
                        console.error("Copy failed: ", err);
                    });
                });
            });
        </script>

    </div>
</section>
@include('client.layouts.footer')
