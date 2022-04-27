@extends('layouts.main')
@section('title')
    Trang chủ
@endsection
@section('content')
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 style="text-align:center">Danh sách nhân viên</h1>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Thông báo: </strong>{{ session('error') }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Thông báo: </strong>{{ session('success') }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @error('id')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Thông báo: </strong>{{ $message }}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @enderror
                    @if (Auth::user()->is_admin || Auth::user()->role_id == config('const.ROLE.MANAGE'))
                        <div class="card-body row">
                            @if (Auth::user()->is_admin)
                                <div style="padding: 0; width: auto" class="col-md-3">
                                    <button type="button" class="btn btn-success addButton" data-bs-toggle="modal"
                                        data-bs-target="#formModal"><i class="fas fa-user-plus"></i> Thêm nhân
                                        viên</button>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary exportButton"><i
                                        class="fas fa-file-export"></i> Xuất file excel</button>
                            </div>
                        </div>
                    @endif

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="GET" id="submit">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="input-group">
                                            <input type="search" name="keyword"
                                                value="{{ isset($_GET['keyword']) ? $_GET['keyword'] : '' }}"
                                                class="form-control" placeholder="Nhập tên hoặc email...">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary filterButton">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1" style="padding: 0">
                                        <select class="form-select form-select" name="department_id"
                                            onchange="$('#submit').submit()">
                                            <option value="" selected disabled>Phòng ban</option>
                                            @foreach ($allDepart as $item)
                                                <option value="{{ $item->id }}" @if (isset($_GET['department_id']) && $_GET['department_id'] == $item->id) selected @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-1" style="padding: 0">
                                        <select class="form-select form-select" name="status"
                                            onchange="$('#submit').submit()">
                                            <option value="" selected disabled>Trạng thái</option>
                                            @foreach (config('const.WORK_STATUS') as $key => $value)
                                                <option value="{{ $value }}" @if (isset($_GET['status']) && $_GET['status'] == $value) selected @endif>
                                                    {{ __('const.WORK_STATUS.' . $value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2" style="padding: 0">
                                        <select id="sort-select" class="form-select form-select" name="sort_by"
                                            onchange="$('#submit').submit()">
                                            <option value="" selected disabled>Sắp xếp theo</option>
                                            @foreach (config('const.SORT_BY') as $key => $value)
                                                <option value="{{ $value }}" @if (isset($_GET['sort_by']) && $_GET['sort_by'] == $value) selected @endif>
                                                    {{ __('const.SORT_BY.' . $key) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-1" style="padding: 0">
                                        <a href="{{route('user.list')}}" class="btn btn-outline-secondary">Đặt lại</a>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                            <span class="input-group-text">Số bản ghi</span>
                                            <select class="form-select" name="item_per_page">
                                                @foreach (config('const.ITEM_PER_PAGE') as $item)
                                                    <option value="{{ $item }}" @if (isset($_GET['item_per_page']) && $_GET['item_per_page'] == $item) selected @endif>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-1">
                                        {!! $allUser->appends($_GET)->links() !!}
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if (count($allUser) > 0)
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Ảnh đại diện</th>
                                        <th>Email</th>
                                        <th>Họ tên</th>
                                        <th>Số điện thoại</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Ngày bắt đầu làm việc</th>
                                        <th scope="col">Phòng ban</th>
                                        <th scope="col">Chức vụ</th>
                                        <th scope="col">Trạng thái</th>
                                        @if (Auth::user()->is_admin)
                                            <th scope="col">Chức năng</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUser as $user)
                                        <tr>
                                            <td scope="row">
                                                <img src="{{ asset('images/UserAvatar/' . $user->avatar) }}"
                                                    height="150px" width="150px">
                                            <td scope="row">
                                                {{ $user->email }}</td>
                                            <td scope="row">
                                                {{ $user->fullname }}</td>
                                            <td scope="row">
                                                {{ $user->phone }}</td>
                                            <td scope="row">
                                                {{ date('d-m-Y', strtotime($user->birth_day)) }}</td>
                                            <td scope="row">
                                                {{ date('d-m-Y', strtotime($user->start_date)) }}</td>
                                            <td scope="row">
                                                {{ $user->depart->name }}</td>
                                            <td scope="row">
                                                @if ($user->is_admin)
                                                    Admin
                                                @else
                                                    {{ $user->role->name }}
                                                @endif
                                            </td>
                                            <td scope="row">
                                                {{ __('const.WORK_STATUS.' . $user->status) }} </td>
                                            @if (Auth::user()->is_admin)
                                                <td scope="row">
                                                    <button type="button" class="btn btn-info editButton"
                                                        value="{{ $user->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#formModal"><i class="fas fa-edit"
                                                            title="Sửa"></i></button>
                                                    <button type="button" class="btn btn-warning resetPassword"
                                                        data-bs-toggle="modal" data-bs-target="#resetPassword"
                                                        data-userid="{{ $user->id }}"
                                                        data-useremail="{{ $user->email }}"><i class="fas fa-redo"
                                                            title="Đặt lại mật khẩu"></i></button>
                                                    <button type="button" class="btn btn-danger deleteUser"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        data-userid="{{ $user->id }}"
                                                        data-useremail="{{ $user->email }}"><i class="fas fa-trash-alt"
                                                            title="Xoá"></i></button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="text" id="exportData" value="{{ route('user.export') }}" hidden>

                        @else
                            <h2>Không có nhân viên tồn tại</h2>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    @include('users.add_edit')
    @include('users.delete')
    @include('users.reset_password')
@endsection
@section('script')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
