@extends('admin.layouts.main')

@section('content')

        <div class="card">
            <div class="card-body">
                <h1>{{ $title }}</h1>

                <div class="d-flex justify-content-end mt-3 mb-3">
                    <form class="row " role="search" action="{{ route('list.product') }}" method="get">
                        <div class="mr10 d-flex">
                            <select name="status" class="form-select mr10" id="">
                                <option value="0" {{ (request('status') ?: old('status')) == 0 ? 'selected' : '' }}>Tất cả</option>
                                <option value="1" {{ (request('status') ?: old('status')) == 1 ? 'selected' : '' }}>Đang hoạt động
                                </option>
                                <option value="2" {{ (request('status') ?: old('status')) == 2 ? 'selected' : '' }}>Không hoạt động
                                </option>
                            </select>

                            <input class="form-control " name="search" type="search" value="{{ request('search') ?: old('search') }}"
                                placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success ml10 mr10" type="submit">Search</button>
                        </div>
                    </form>
                    <form action="{{ route('deleteAll.product') }}" method="post" id="delete-form">
                        @csrf
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Hành động
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('create.product') }}">Thêm mới</a></li>
                            <li><a class="dropdown-item" href="{{ route('trash.product') }}">Thùng rác</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"
                                    onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-striped text-center mb-3">
                        <thead>
                            <tr>
                                <td>
                                    <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                                </td>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh bìa</th>
                                <th scope="col">Giá gốc</th>
                                <th scope="col">Giá giảm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $value)
                                <tr>
                                    {{-- <td>
                                        @foreach ($productSizes->where('product_id', $value->id) as $productSize)
                                            <li>{{ $productSize->sizes->name }}</li>
                                        @endforeach
                                    </td> --}}
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="ids[{{ $value->id }}]"
                                            value="{{ $value->id }}">
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td><img src="{{ Storage::url($value->image) }}" width="50" alt=""></td>
                                    <td>{{ $value->selling_price }}</td>
                                    <td>{{ $value->discount_price }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->quantity == 0 ? 'Hết hàng' : 'Còn hàng' }}</td>
                                    <td>
                                        <?php $productUrl = '/admin/product/destroy/'; ?>
                                        <a href="/admin/product/destroy/{{ $value->id }}"
                                            onclick="event.preventDefault(); showDeleteConfirm('{{ $value->id }}','{{ $productUrl }}');"
                                            class="btn btn-danger"><i class='bx bx-trash'></i></a>
                                        <a href="/admin/product/edit/{{ $value->id }}" class="btn btn-primary"><i
                                                class='bx bx-edit'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </form>
    {{ $products->links() }}
    </div>
    </div>
@endsection
