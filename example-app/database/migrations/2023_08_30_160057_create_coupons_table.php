<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code'); //mã
            $table->string('type'); //loại
            $table->string('value'); //giá trị
            $table->string('quantity'); //số lượng
            $table->longText('description'); //số lượng
            $table->string('min_order_amount')->nullable(); // số tiền tối thiểu
            $table->string('max_order_amount')->nullable(); //số tiền tối đa
            $table->timestamps('start_date'); // ngày bắt đầu
            $table->timestamps('end_date'); // ngày kết thúc
            $table->string('status')->nullable(); // trạng thái
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
