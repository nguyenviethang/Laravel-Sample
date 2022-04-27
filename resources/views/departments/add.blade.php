<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('department.store') }}" id="addForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><label id="lableTitle">Thêm phòng ban</label></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label">Tên phòng ban</label>
                                    <input type="text" class="form-control form-control" name="name" />
                                </div>

                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label">Mô tả</label>
                                    <input type="text" class="form-control form-control" name="description" />
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label">Quản lý</label>
                                    <select id="sort-select" class="form-select form-select" name="user_id">
                                        <option value="" selected disabled>Chọn quản lý</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary saveButton">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
