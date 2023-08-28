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
        <a href="{{ route('add.slider') }}" class="btn btn-success">Create</a>
    </div>

    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Nội dung</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <?= $item->content ?? 'Trống' ?>
                    </td>
                    <td><img src="{{ Storage::url($item->image) }}" width="50" alt=""></td>
                    <td>{{ $item->status==1?'Đang kích hoạt':'Không kích hoạt' }}</td>

                    <td>
                        <?php $sliderUrl='/admin/interfaces/slider/destroy/'; ?>
                        <a href="{{ route('destroy.slider', ['id' => $item->id]) }}" onclick="event.preventDefault(); showDeleteConfirm('{{ $item->id }}','{{ $sliderUrl }}');" class="btn btn-danger mt-1"><i
                                class='bx bx-trash'></i></a>
                            <a href="{{ route('edit.slider', ['id' => $item->id]) }}" class="btn btn-primary"><i
                                    class='bx bx-edit'></i></a>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $data->links() }}

@endsection
