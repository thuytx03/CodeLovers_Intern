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
    <form action="{{ route('restore.user') }}" method="post" id="restore-form">
        @csrf
        <div class="d-flex justify-content-end mt-3 mb-3">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hành động
                </button>
                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); confirmRestore(event);">Khôi phục</a></li>
                    <li><a class="dropdown-item" href="{{ route('list.user') }}">Danh sách người dùng</a></li>

                </ul>
            </div>
        </div>

        @if ($users->isEmpty())
            <h3 class="text-center ">Thùng rác trống</h3>
        @else
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
                        <th>Giới tính </th>
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
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td><img src="{{ $item->avatar }}" width="30" alt=""></td>
                            <td>{{ $item->role->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                            <td>
                                <?php $userUrl = '/admin/users/permanentlyDelete/'; ?>
                                <a href="/admin/users/permanentlyDelete/{{ $item->id }}" class="btn btn-danger"
                                    onclick="event.preventDefault(); showDeleteConfirmPermanently('{{ $item->id }}','{{ $userUrl }}')">
                                    <i class='bx bx-trash'></i>
                                </a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </form>


@endsection
