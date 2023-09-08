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


    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->status == 1 ? 'Chưa liên hệ' : 'Đã liên hệ' }}</td>
                    <td>
                        @if($item->status != 2)
                        <a href="{{ route('confirm.contact',['id'=>$item->id]) }}" class="btn btn-primary"><i class='bx bx-edit'></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $data->links() }}

@endsection
