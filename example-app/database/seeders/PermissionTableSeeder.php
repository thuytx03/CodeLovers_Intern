<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //admin
            ['name'=>'admin-dashboard','display_name'=>'Dashboard Admin', 'group'=>'Admin'],


            //Tài khoản
            ['name'=>'user-list','display_name'=>'Danh sách tài khoản', 'group'=>'Tài khoản'],
            ['name'=>'user-add','display_name'=>'Thêm mới tài khoản', 'group'=>'Tài khoản'],
            ['name'=>'user-edit','display_name'=>'Chỉnh sửa tài khoản', 'group'=>'Tài khoản'],
            ['name'=>'user-delete','display_name'=>'Xoá tài khoản', 'group'=>'Tài khoản'],
            ['name'=>'user-trash','display_name'=>'Thùng rác tài khoản', 'group'=>'Tài khoản'],
            //Vai trò
            ['name'=>'role-list','display_name'=>'Danh sách vai trò', 'group'=>'Vai trò'],
            ['name'=>'role-add','display_name'=>'Thêm mới vai trò', 'group'=>'Vai trò'],
            ['name'=>'role-edit','display_name'=>'Chỉnh sửa vai trò', 'group'=>'Vai trò'],
            ['name'=>'role-delete','display_name'=>'Xoá vai trò', 'group'=>'Vai trò'],
            //Quyền
            ['name'=>'permission-list','display_name'=>'Danh sách quyền', 'group'=>'Quyền'],
            ['name'=>'permission-add','display_name'=>'Thêm mới quyền', 'group'=>'Quyền'],
            ['name'=>'permission-edit','display_name'=>'Chỉnh sửa quyền', 'group'=>'Quyền'],
            ['name'=>'permission-delete','display_name'=>'Xoá quyền', 'group'=>'Quyền'],

            //Danh mục sản phẩm
            ['name'=>'category-list','display_name'=>'Danh sách danh mục sản phẩm', 'group'=>'Danh mục sản phẩm'],
            ['name'=>'category-add','display_name'=>'Thêm mới danh mục sản phẩm', 'group'=>'Danh mục sản phẩm'],
            ['name'=>'category-edit','display_name'=>'Chỉnh sửa danh mục sản phẩm', 'group'=>'Danh mục sản phẩm'],
            ['name'=>'category-delete','display_name'=>'Xoá danh mục sản phẩm', 'group'=>'Danh mục sản phẩm'],
            ['name'=>'category-trash','display_name'=>'Thùng rác danh mục sản phẩm', 'group'=>'Danh mục sản phẩm'],

            //Sản phẩm
            ['name'=>'product-list','display_name'=>'Danh sách sản phẩm', 'group'=>'Sản phẩm'],
            ['name'=>'product-add','display_name'=>'Thêm mới sản phẩm', 'group'=>'Sản phẩm'],
            ['name'=>'product-edit','display_name'=>'Chỉnh sửa sản phẩm', 'group'=>'Sản phẩm'],
            ['name'=>'product-delete','display_name'=>'Xoá sản phẩm', 'group'=>'Sản phẩm'],
            ['name'=>'product-trash','display_name'=>'Thùng rác sản phẩm', 'group'=>'Sản phẩm'],

            //Thuộc tính sản phẩm
            ['name'=>'attribute-menu','display_name'=>'Danh sách màu sắc', 'group'=>'Thuộc tính sản phẩm'],

            ['name'=>'color-list','display_name'=>'Danh sách màu sắc', 'group'=>'Thuộc tính Màu sắc'],
            ['name'=>'color-add','display_name'=>'Thêm mới màu sắc', 'group'=>'Thuộc tính Màu sắc'],
            ['name'=>'color-edit','display_name'=>'Chỉnh sửa màu sắc', 'group'=>'Thuộc tính Màu sắc'],
            ['name'=>'color-delete','display_name'=>'Xoá màu sắc', 'group'=>'Thuộc tính Màu sắc'],

            ['name'=>'size-list','display_name'=>'Danh sách kích thước', 'group'=>'Thuộc tính Kích thước'],
            ['name'=>'size-add','display_name'=>'Thêm mới kích thước', 'group'=>'Thuộc tính Kích thước'],
            ['name'=>'size-edit','display_name'=>'Chỉnh sửa kích thước', 'group'=>'Thuộc tính Kích thước'],
            ['name'=>'size-delete','display_name'=>'Xoá kích thước', 'group'=>'Thuộc tính Kích thước'],

            //Giao diện

            ['name'=>'interface-menu','display_name'=>'Danh sách màu sắc', 'group'=>'Giao diện'],
            //Logo
            ['name'=>'logo-interface','display_name'=>'Logo Website', 'group'=>'Logo'],
            //slider
            ['name'=>'slider-list','display_name'=>'Danh sách slider', 'group'=>'Slider'],
            ['name'=>'slider-add','display_name'=>'Thêm mới slider', 'group'=>'Slider'],
            ['name'=>'slider-edit','display_name'=>'Chỉnh sửa slider', 'group'=>'Slider'],
            ['name'=>'slider-delete','display_name'=>'Xoá slider', 'group'=>'Slider'],

            //Order
            ['name'=>'order-list','display_name'=>'Danh sách đơn hàng', 'group'=>'Đơn hàng'],

            //Mã giảm giá
            ['name'=>'coupon-list','display_name'=>'Danh sách mã giảm giá', 'group'=>'Mã giảm giá'],
            ['name'=>'coupon-add','display_name'=>'Thêm mới mã giảm giá', 'group'=>'Mã giảm giá'],
            ['name'=>'coupon-edit','display_name'=>'Chỉnh sửa mã giảm giá', 'group'=>'Mã giảm giá'],
            ['name'=>'coupon-delete','display_name'=>'Xoá mã giảm giá', 'group'=>'Mã giảm giá'],

            //Liên hệ
            ['name'=>'contact-list','display_name'=>'Danh sách liên hệ', 'group'=>'Liên hệ'],

            //Đánh giá
            ['name'=>'rating-list','display_name'=>'Danh sách đánh giá', 'group'=>'Đánh giá'],

            //Danh mục bài viết
            ['name'=>'type-list','display_name'=>'Danh sách danh mục bài viết', 'group'=>'Danh mục bài viết'],
            ['name'=>'type-add','display_name'=>'Thêm mới danh mục bài viết', 'group'=>'Danh mục bài viết'],
            ['name'=>'type-edit','display_name'=>'Chỉnh sửa danh mục bài viết', 'group'=>'Danh mục bài viết'],
            ['name'=>'type-delete','display_name'=>'Xoá danh mục bài viết', 'group'=>'Danh mục bài viết'],
            ['name'=>'type-trash','display_name'=>'Thùng rác danh mục bài viết', 'group'=>'Danh mục bài viết'],

            //Bài viết
            ['name'=>'blog-list','display_name'=>'Danh sách bài viết', 'group'=>'Bài viết'],
            ['name'=>'blog-add','display_name'=>'Thêm mới bài viết', 'group'=>'Bài viết'],
            ['name'=>'blog-edit','display_name'=>'Chỉnh sửa bài viết', 'group'=>'Bài viết'],
            ['name'=>'blog-delete','display_name'=>'Xoá bài viết', 'group'=>'Bài viết'],
            ['name'=>'blog-trash','display_name'=>'Thùng rác bài viết', 'group'=>'Bài viết'],


        ];

        foreach ($permissions as $permission) {
             Permission::updateOrCreate($permission);
        }
    }
}
