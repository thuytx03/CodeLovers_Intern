<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction):
                    case "store":
                        $rules = [
                            "name" => "required|unique:products",
                            "slug" => "unique:products",
                            "image" => "required",
                            "images" => "required",
                            "brand" => "required",
                            "selling_price" => "required",
                            "quantity" => "required",
                            "description" => "required",
                            // "size_id" => "required",
                            // "color_id" => "required",
                            // "status" => "required",
                        ];
                        break;
                endswitch;
            break;
            case 'PUT':
                switch ($currentAction):
                    case "update":
                        $rules = [
                            "name" => ['required', Rule::unique('products')->ignore($this->id)] ,
                            "slug" =>  [Rule::unique('products')->ignore($this->id)],
                            "brand" => "required",
                            "selling_price" => "required",
                            "quantity" => "required",
                            "description" => "required",
                            // "size_id" => "required",
                            // "color_id" => "required",
                            // "status" => "required",
                        ];
                        break;
                endswitch;
            break;
        endswitch;
        return $rules;
    }

    public function messages()
    {
        return [
            "name.required" => "Không được để trống tên sản phẩm",
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'slug.unique' => 'Tên đường dẫn đã tồn tại',
            "image.required" => "Không được để trống ảnh bìa sản phẩm",
            "images.required" => "Không được để trống ảnh sản phẩm",
            "brand.required" => "Không được để trống thương hiệu sản phẩm",
            "selling_price.required" => "Không được để trống giá sản phẩm",
            "quantity.required" => "Không được để trống số lượng sản phẩm",
            "description.required" => "Không được để trống mô tả sản phẩm",
            // "size_id.required" => "Không được để trống kích sản phẩm",
            // "color_id.required" => "Không được để trống màu sắc sản phẩm",
            // "status.required" => "Không được để trống trạng thái sản phẩm",
        ];
    }
}
