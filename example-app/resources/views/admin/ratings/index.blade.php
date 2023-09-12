@extends('admin.layouts.main')
@section('content')
    <h1>{{ $title }}</h1>
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
    <form action="{{ route('deleteAll.rating') }}" method="post" id="delete-form">
        @csrf
        <div class="d-flex justify-content-end mt-3 mb-3">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hành động
                </button>
                <ul class="dropdown-menu">
                   
                    <li><a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>
                </ul>
            </div>
        </div>

        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <td>
                        <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                    </td>
                    <th>Người đánh giá</th>
                    <th>Tên sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Số sao</th>
                    <th>Thời gian</th>
                    <th>
                        Hành động
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rating as $value)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input" name="ids[{{ $value->id }}]"
                                value="{{ $value->id }}">
                        </td>
                        <td>{{ $value->user->name }}</td>
                        <td>{{ Str::limit($value->product->name,15,'...') }}</td>
                        <td>{{ Str::limit($value->review,10,'...') }}</td>
                        <?php
                        $array = json_decode($value->rating, true); // Sử dụng 'true' để chuyển đổi thành mảng kết hợp
                        $countRating = count($array);
                        ?>
                        <td>
                            {{ $countRating }} sao
                        </td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <?php $ratingUrl = '/admin/rating/destroy/'; ?>

                            <a href="/admin/rating/destroy/{{ $value->id }}"
                                onclick="event.preventDefault(); showDeleteConfirm('{{ $value->id }}','{{ $ratingUrl }}');"
                                class="btn btn-danger"><i class='bx bx-trash'></i></a>
                            <a href="/admin/rating/edit/{{ $value->id }}" class="btn btn-primary"><i
                                    class='bx bx-edit'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    {{ $rating->links() }}

@endsection
