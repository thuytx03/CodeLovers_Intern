<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['code','type','value','min_order_amount','max_order_amount','applicable_to_all_products','start_date','end_date'];

    public function checkAndSetStatus()
    {
        $now = Carbon::now();

        // Kiểm tra nếu ngày hiện tại vượt qua end_date
        if ($now > $this->end_date) {
            $this->status = 2; // Cập nhật trạng thái thành 2 (hết hạn)
            $this->save(); // Lưu thay đổi vào cơ sở dữ liệu
        }
    }
}
