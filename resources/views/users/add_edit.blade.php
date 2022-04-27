<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('user.store') }}" id="addForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><label id="lableTitle"></label></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="success" class="alert alert-success" style="display:none"><strong>Thông báo: </strong></div>
                <div id="error" class="alert alert-danger" style="display:none"><strong>Thông báo: </strong>
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="alert alert-danger alert-dismissible fade show" id="errorUser" role="alert"
                            style="display:none">
                            <strong>{{ __('message.errorUser') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="text" value="" name="id" hidden>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label">Email<i class="text-danger">*</i>
                                    </label>
                                    <input type="text" class="form-control form-control" name="email" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label">Họ tên<i class="text-danger">*</i>
                                    </label>

                                    <input type="text" class="form-control form-control" name="fullname" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                <div class="form-outline datepicker w-100">
                                    <label class="form-label">Sinh nhật<i class="text-danger">*</i>
                                    </label>
                                    <input type="text" id="birth_day"  class="form-control form-control" name="birth_day" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline datepicker w-100">
                                    <label class="form-label">Ngày bắt đầu làm việc<i class="text-danger">*</i>
                                    </label>
                                    <input type="text" id="start_date" class="form-control form-control" name="start_date" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <label class="form-label">Số điện thoại<i class="text-danger">*</i>
                                    </label>
                                    <input type="text" class="form-control form-control" name="phone" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <label class="form-label">Phòng ban<i class="text-danger">*</i>
                                    </label>
                                    <select class="form-select" name="department_id" id="department">
                                        <option value="">Phòng ban</option>
                                        @foreach ($allDepart as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <label class="form-label">Chức vụ<i class="text-danger">*</i>
                                    </label>
                                    <div class="row">
                                        @foreach ($allRole as $role)
                                            <div class="col-sm-3">
                                                <label class="form-check-label" style="padding-right: 30px;">
                                                    {{ $role->name }}
                                                </label>
                                                <input class="form-check-input roleInput" type="radio" name="role_id"
                                                    id="role_id" value="{{ $role->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                    <label class="form-label">Trạng thái<i class="text-danger">*</i>
                                    </label>
                                    <div class="row">
                                        @foreach (config('const.WORK_STATUS') as $key => $value)
                                            <div class="col-sm-5">
                                                <label class="form-check-label" style="padding-right: 30px;">
                                                    {{ __('const.WORK_STATUS.' . $value) }}
                                                </label>
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="{{ $value }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <label class="form-label">Ảnh đại diện</label>
                                    <input type="file" class="form-control form-control" name="avatar"
                                        id="inputAvatar" />
                                    <div class="col">
                                        <img id="imagePreview" width="150" height="150" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="updateUser" value="{{ route('user.update') }}" hidden>
                <input type="text" id="addUser" value="{{ route('user.store') }}" hidden>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary saveButton">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
