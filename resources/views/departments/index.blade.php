@extends('layouts.main')
@section('title')
    Trang chủ
@endsection
@section('content')
    {{-- @dd($allDepartments) --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 style="text-align:center">Danh sách phòng ban</h1>
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
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Thông báo: </strong>{{ $message }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        @error('description')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Thông báo: </strong>{{ $message }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        @error('user_id')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Thông báo: </strong>{{ $message }}.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="card-body">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success addButton" data-bs-toggle="modal"
                                    data-bs-target="#formModal"><i class="fas fa-user-plus"></i>Thêm phòng ban</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($allDepartments) > 0)
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tên phòng ban</th>
                                            <th>Mô tả</th>
                                            <th>Người quản lý</th>
                                            <th colspan="2">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allDepartments as $department)
                                            <tr>
                                                <td scope="row">
                                                    {{ $department->name }}</td>
                                                <td scope="row">
                                                    {{ $department->description }}</td>
                                                <td scope="row">
                                                    @if (isset($department->manager->fullname))
                                                        {{ $department->manager->fullname }}
                                                    @endif
                                                </td>
                                                <td scope="row">
                                                    <button type="button" class="btn btn-info " value=""
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editForm{{ $department->id }}"><i
                                                            class="fas fa-edit" title="Sửa"></i></button>
                                                    @include('departments.edit')
                                                </td>
                                                <td scope="row">
                                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                                        data-bs-target="#deleteForm{{ $department->id }}"><i
                                                            class="fas fa-trash-alt" title="Xoá"></i></button>
                                                    @include('departments.delete')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h2>Không có nhân viên tồn tại</h2>
                            @endif
                            <br>
                            <div class="float-right">
                                {!! $allDepartments->links() !!}
                            </div>
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
    </section>
    <!-- /.content -->
    </div>
    @include('departments.add')
@endsection
