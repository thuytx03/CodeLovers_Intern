<?php

// app/Helpers/DiscountHelper.php

namespace App\Helpers;

use App\Models\Coupon;
use Carbon\Carbon;

class CouponHelper {

    public static function updateDiscountsStatus() {
        $currentDate = Carbon::now()->toDateString();

        $coupons = Coupon::all();

        foreach ($coupons as $coupon) {
            if ($currentDate > $coupon->end_date && $coupon->status != 2) {
                $coupon->status = 2;
                $coupon->save();
            }
        }
    }
}
