<div class="modal fade" id="deleteForm{{ $department->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" id="deleteForm">
        <div class="modal-content">
            <form action="{{ route('department.delete') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><label id="lableTitle">Xoá phòng ban?</label></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="id" value="{{ $department->id }}" hidden>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label">Có chắc muốn xoá phòng:
                                        {{ $department->name }}?</label>
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
