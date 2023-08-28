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
    <form action="{{ route('restore.product') }}" method="post" id="restore-form">
        <div class="d-flex justify-content-end mt-3 mb-3">
            <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hành động
                </button>
                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); confirmRestore(event);">Khôi phục</a></li>
                    <li><a class="dropdown-item" href="{{ route('list.product') }}">Danh sách sản phẩm</a></li>
                </ul>
            </div>
        </div>
        @csrf
        @if ($products->isEmpty())
            <h3 class="text-center ">Thùng rác trống</h3>
        @else
            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <td>
                            <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                        </td>
                        <th>Tên vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $item)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" name="ids[{{ $item->id }}]"
                                    value="{{ $item->id }}">
                            </td>
                            <td>{{ $item->name }}</td>

                            <td>
                                <?php $productUrl = '/admin/product/permanentlyDelete/'; ?>
                                <a href="/admin/product/permanentlyDelete/{{ $item->id }}" class="btn btn-danger"
                                    onclick="event.preventDefault(); showDeleteConfirmPermanently('{{ $item->id }}','{{ $productUrl }}')">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
    </form>
    @endif
    {{-- {{ $roles->links() }} --}}

@endsection
