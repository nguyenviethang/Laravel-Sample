@extends('layouts.main')
@section('title')
    Đổi mật khẩu
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong>{{ session('error') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-flex justify-content-center">
        <h1>Đổi mật khẩu</h1>
    </div>

    <div class="col-sm-4 mx-auto">
        <form method="post" action="{{ route('change.password') }}" method="post">
            @csrf
            <input type="text" value="{{ Auth::user()->id }}" name="id" hidden>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" class="form-control" name="old_password">
                @error('old_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" name="new_password">
                @error('new_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" class="form-control" name="password_confirmed">
                @error('password_confirmed')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('profile') }}" class="btn btn-secondary" role="button" aria-pressed="true"
                style="margin: 0 auto;">Huỷ</a>
            <button type="submit" class="btn btn-primary">Thay đổi</button>
        </form>
    </div>
@endsection
