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


    {{-- Quản lý size --}}
    <form action="{{ route('deleteAllSize.attributes') }}" method="post" id="delete-form">

            <div class="d-flex justify-content-end mt-3 mb-3 ">

                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hành động
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('addSize.attributes') }}">Thêm mới</a></li>
                        <li><a class="dropdown-item" href="{{ route('trash.role') }}">Thùng rác</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);"
                                onclick="event.preventDefault(); confirmDelete(event);">Xoá mục chọn</a></li>

                    </ul>
                </div>
            </div>

        @csrf
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <td>
                        <input type="checkbox" name="" class="form-check-input" id="select_all_ids">
                    </td>
                    <th>Tên</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $key => $item)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input" name="ids[{{ $item->id }}]"
                                value="{{ $item->id }}">
                        </td>
                        <td>{{ $item->name }}</td>

                        <td>
                            <?php $sizeUrl = '/admin/attributes/destroySize/'; ?>
                            <a href="{{ route('destroySize.attributes',['id'=>$item->id]) }}"
                                onclick="event.preventDefault(); showDeleteConfirm('{{ $item->id }}','{{ $sizeUrl }}');"
                                class="btn btn-danger mt-1"><i class='bx bx-trash'></i></a>

                            <a href="{{ route('editSize.attributes',['id'=>$item->id]) }}" class="btn btn-primary"><i class='bx bx-edit'></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    {{ $sizes->links() }}

@endsection
