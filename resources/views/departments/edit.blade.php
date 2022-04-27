<div class="modal fade" id="editForm{{ $department->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" id="editForm">
        <div class="modal-content">
            <form action="{{ route('department.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><label id="lableTitle">Sửa phòng ban</label></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="id" value="{{ $department->id }}" hidden>
                                <div class="form-outline">
                                    <label class="form-label">Tên phòng ban</label>
                                    <input type="text" class="form-control form-control" name="name"
                                        value="{{ $department->name }}" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label">Mô tả</label>
                                    <input type="text" class="form-control form-control" name="description"
                                        value="{{ $department->description }}" />
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
                                        @if (isset($department->manager->fullname))
                                           <option value="{{ $department->manager->id}}" selected>{{ $department->manager->fullname }}</option>
                                        @endif
                                        @foreach ($department->users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->fullname }}</option>
                                        @endforeach
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
