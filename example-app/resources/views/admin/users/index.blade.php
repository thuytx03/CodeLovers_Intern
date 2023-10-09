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
    <div class="d-flex justify-content-end mt-3 mb-3">

        <form class="row " role="search" action="{{ route('list.user') }}" method="get">
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
        <form action="{{ route('deleteAll.user') }}" method="post" id="delete-form">
            @csrf
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Hành động
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('add.user') }}">Thêm mới</a></li>
                    <li><a class="dropdown-item" href="{{ route('trash.user') }}">Thùng rác</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>
                </ul>
            </div>
    </div>

    <table class="table table-striped table-hover text-center table-responsive-md">
        <thead>
            <tr>
                <td>
                    <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                </td>
                <th>Tên </th>
                <th>Email</th>
                <th>Hình ảnh </th>
                <th>Vai trò</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>

                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $item)
                <tr>
                    <td>
                        <input type="checkbox" class="form-check-input" name="ids[{{ $item->id }}]"
                            value="{{ $item->id }}">
                    </td>
                    <td>{{ $item->name ?? 'Trống' }}</td>
                    <td>{{ $item->email ?? 'Trống' }}</td>
                    <td><img src="{{ $item->avatar }}" width="30" alt=""></td>

                    <td class="text-center">
                        @if (!empty($item->getRoleNames()))
                            @foreach ($item->getRoleNames() as $v)
                                <span class="badge bg-label-primary me-1">
                                    {{ $v }}
                                </span>
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $item->phone ?? 'Trống' }}</td>

                    <td class="text-center">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input switch-status" name="status" type="checkbox" id="flexSwitchCheckChecked"
                                {{ $item->status == 1 ? 'checked' : '' }}
                                value="{{ $item->status }}"
                                data-item-id="{{ $item->id }}"
                            >
                        </div>
                    </td>

                    <script>
                        $(document).ready(function () {
                            $('.switch-status').change(function () {
                                const itemId = $(this).data('item-id');
                                const status = this.checked ? 1 : 2;

                                $.ajax({
                                    method: 'POST',
                                    url: 'users/update-status/' + itemId,
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        status: status
                                    },
                                    success: function (data) {
                                        // Xử lý phản hồi thành công (nếu cần)
                                    },
                                    error: function (error) {
                                        // Xử lý lỗi (nếu có)
                                    }
                                });
                            });
                        });
                    </script>

                    <td>
                        <?php $user = '/admin/users/destroy/'; ?>
                        <a href="/admin/users/destroy/{{ $item->id }}"
                            onclick="event.preventDefault(); showDeleteConfirm('{{ $item->id }}','{{ $user }}');"
                            class="btn btn-danger mt-1"><i class='bx bx-trash'></i></a>
                        <a href="/admin/users/edit/{{ $item->id }}" class="btn btn-primary mt-1"><i
                                class='bx bx-edit'></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $users->links() }}
    </form>


@endsection

