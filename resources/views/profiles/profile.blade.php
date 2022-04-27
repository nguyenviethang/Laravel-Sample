@extends('layouts.main')
@section('title')
    Profile
@endsection
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <h2>Thông tin cá nhân</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/UserAvatar/' . Auth::user()->avatar) }}" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ $user->fullname }}</h5>
                            <p class="text-muted mb-1">{{ $user->role->name }}</p>
                            <p class="text-muted mb-4">{{ $user->depart->name }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-info" id="editBtn" data-bs-toggle="modal"
                                    data-bs-target="#formModal" style="margin: 0 auto;">Sửa thông tin</button>
                                <a href="{{ route('change.password.view') }}" class="btn btn-info"
                                    role="button" aria-pressed="true" style="margin: 0 auto;">Đổi mật khẩu</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Họ và tên</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->fullname }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Số điện thoại</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->phone }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Ngày sinh</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ date('d-m-Y', strtotime($user->birth_day)) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Ngày bắt đầu làm việc</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ date('d-m-Y', strtotime($user->start_date)) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Trạng thái</p>
                                </div>
                                <div class="col-sm-9">
                                    {{ __('const.WORK_STATUS.' . $user->status) }}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('profiles.edit')
@endsection
@section('script')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
